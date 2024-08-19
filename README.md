# The V app

The app verifies license codes.

# Tech stack

- PHP/Laravel 
- MySQL
- Redis
- Docker
- GitHub actions
- Helm
- Kubernets
- Terraform
- Hetzner Cloud

# Infrastructure

Based on the `module "kube-hetzner"` terraform module. Check the [project docs](https://github.com/kube-hetzner/terraform-hcloud-kube-hetzner) for more details 

1) You should have an account at Hetzner Cloud. 
Set your account token with `export TF_VAR_hcloud_token=xxxxxxxxxxxx`
2) Create an OpenSUSE MicroOS snapshot at your Hetzner account
3) Update the variables in the `infra` folder
4) Run `terraform init` and `terraform apply` commands

# URL

1) Update your DNS record with cluster IP

# Changes

1) Commit source code changes
2) GitHub actions should build a new image, publish it, and update the helm chart in the `helm` folder
3) Update the terraform config to use a new app version and run the `terraform apply` command


