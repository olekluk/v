locals {
  hcloud_token = "xxxx"
}

data "http" "myip" {
  url = "https://ipv4.icanhazip.com"
}

module "kube-hetzner" {
  providers = {
    hcloud = hcloud
  }
  hcloud_token = var.hcloud_token != "" ? var.hcloud_token : local.hcloud_token

  source = "kube-hetzner/kube-hetzner/hcloud"

  cluster_name = var.cluster_name

  ssh_port        = var.ssh_port
  ssh_public_key  = file(var.ssh_public_key)
  ssh_private_key = file(var.ssh_private_key)

  network_region = "eu-central"

  control_plane_nodepools = [
    {
      name        = "control-plane",
      server_type = "cx32",
      location    = "fsn1",
      labels      = [],
      taints      = [],
      count       = 1
    }
  ]

  agent_nodepools = [
    {
      name        = "agent",
      server_type = "cpx11",
      location    = "fsn1",
      labels      = [],
      taints      = [],
      count       = 0
    }
  ]

  # load_balancer_type     = "lb11"
  # load_balancer_location = "fsn1"
  initial_k3s_channel = "v1.29"

  lb_hostname = "cluster.brand.com"
  ingress_controller = "nginx"

  enable_klipper_metal_lb           = true
  allow_scheduling_on_control_plane = true

  automatically_upgrade_os = false

  firewall_kube_api_source = ["${chomp(data.http.myip.response_body)}/32"]
}

provider "hcloud" {
  token = var.hcloud_token != "" ? var.hcloud_token : local.hcloud_token
}

provider "kubernetes" {
  config_path = "${path.module}/${var.cluster_name}_kubeconfig.yaml"
}

provider "helm" {
  kubernetes {
    config_path = "${path.module}/${var.cluster_name}_kubeconfig.yaml"
  }
}

resource "kubernetes_namespace" "app" {
  depends_on = [module.kube-hetzner]

  metadata {
    name = var.app_namespace
  }
}

resource "helm_release" "mysql" {
  depends_on = [kubernetes_namespace.app]

  name       = "mysql"
  repository = "https://charts.bitnami.com/bitnami"
  chart      = "mysql"
  version    = "11.1.14" # Specify the version you want to install
  namespace  = kubernetes_namespace.app.metadata[0].name

  values = [
    templatefile("${path.module}/config/mysql-values.tftpl", {
      root_password = var.mysql_root_password
      user_name     = var.mysql_user_name
      user_password = var.mysql_user_password
      database_name = var.mysql_database_name
    })
  ]
}

resource "helm_release" "redis" {
  depends_on = [kubernetes_namespace.app]

  name       = "redis"
  repository = "https://charts.bitnami.com/bitnami"
  chart      = "redis"
  version    = "19.6.4" # specify the chart version you want to use
  namespace  = kubernetes_namespace.app.metadata[0].name

  values = [
    templatefile("${path.module}/config/redis-values.tftpl", {
      password = var.redis_password
    })
  ]

}

resource "helm_release" "vapp" {
  depends_on = [kubernetes_namespace.app]

  name       = "vapp"
  chart      = "https://github.com/olekluk/v/raw/main/helm/v-v1.0.11-462719a.tgz"

  namespace  = kubernetes_namespace.app.metadata[0].name

  values = [
    templatefile("${path.module}/config/vapp-values.tftpl", {
      cert_email = var.app_cert_email
      domain = var.app_domain
      key = var.app_key
      url = var.app_url
      asseturl = var.app_asseturl
      mysql_database_name = var.mysql_database_name
      mysql_user_name = var.mysql_user_name
      mysql_user_password = var.mysql_user_password
      redis_password = var.redis_password
      name = var.app_name
      theme_id = var.app_theme_id
      support_url = var.app_support_url
      support_email = var.app_support_email
      envato_api_endpoint = var.app_envato_api_endpoint
      envato_api_token = var.app_envato_api_token
      cache_use = var.app_cache_use
      cache_ttl = var.app_cache_ttl
    })
  ]

}


terraform {
  required_version = ">= 1.5.0"
  required_providers {
    hcloud = {
      source  = "hetznercloud/hcloud"
      version = ">= 1.43.0"
    }
    kubernetes = {
      source  = "hashicorp/kubernetes"
      version = ">= 2.0.0"
    }
    helm = {
      source  = "hashicorp/helm"
      version = ">= 2.0.0"
    }
  }
}

output "kubeconfig" {
  value     = module.kube-hetzner.kubeconfig
  sensitive = true
}

variable "hcloud_token" {
  sensitive = true
  default   = ""
}

variable "ssh_port" {
  default = "22"
}

variable "ssh_public_key" {
  sensitive = true
  default   = ""
}

variable "ssh_private_key" {
  sensitive = true
  default   = ""
}

variable "cluster_name" {
  default = "clustername"
}

variable "app_namespace" {
  default = "ns"
}

variable "mysql_root_password" {
  default   = ""
  sensitive = true
}

variable "mysql_user_name" {
  default   = ""
  sensitive = true
}

variable "mysql_user_password" {
  default   = ""
  sensitive = true
}

variable "mysql_database_name" {
  default = "dbname"
}

variable "redis_password" {
  sensitive = true
  default   = ""
}

variable "app_cert_email" {
  sensitive = true
  default   = "you@brand.com"
}

variable "app_domain" {
  default   = "brand.com"
}

variable "app_key" {
  default   = ""
}

variable "app_url" {
  default   = "https://brand.com"
}

variable "app_asseturl" {
  default   = "https://brand.com" 
}

variable "app_name" {
  default   = "the v app" 
}

variable "app_theme_id" {
  default   = "9999999" 
}

variable "app_support_url" {
  sensitive = true
  default   = ""
}

variable "app_support_email" {
  sensitive = true
  default   = ""
}

variable "app_envato_api_endpoint" {
  default   = "https://api.envato.com/v3/market/"
}

variable "app_envato_api_token" {
  sensitive = true
  default   = ""
}

variable "app_cache_use" {
  default   = "true"
}

variable "app_cache_ttl" {
  default   = "168"
}