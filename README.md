# Kubernetes + Docker + GCP — Desafio DIO

Projeto de CI/CD para uma aplicação web containerizada com **Docker**, executada em **Kubernetes** e preparada para deploy no **Google Kubernetes Engine (GKE)**.

## Arquitetura

- **Frontend:** HTML, CSS e JavaScript servido por Nginx
- **Backend:** PHP + Apache
- **Banco:** MySQL
- **Containers:** Docker
- **Orquestração:** Kubernetes
- **Cloud:** Google Cloud Platform / GKE
- **Pipeline:** GitHub Actions + Artifact Registry

## Estrutura

```text
.
├── .github/
│   └── workflows/
│       └── deploy-gke.yml
├── backend/
│   ├── Dockerfile
│   ├── db.php
│   └── index.php
├── database/
│   └── init.sql
├── frontend/
│   ├── Dockerfile
│   ├── app.js
│   ├── index.html
│   ├── nginx.conf
│   └── style.css
├── k8s/
│   ├── backend.yaml
│   ├── frontend.yaml
│   ├── mysql.yaml
│   └── namespace.yaml
├── docker-compose.yml
└── README.md
```

## Executar localmente com Docker Compose

```bash
docker compose up --build -d
```

Acesse:

```text
http://localhost:8080
```

Para encerrar:

```bash
docker compose down
```

## Kubernetes

Crie os recursos:

```bash
kubectl apply -f k8s/
```

Verifique:

```bash
kubectl get all -n dio-kubernetes
```

## Pipeline para o Google Kubernetes Engine

O workflow em `.github/workflows/deploy-gke.yml`:

1. autentica no Google Cloud;
2. configura o Docker para o Artifact Registry;
3. gera as imagens Docker do frontend e backend;
4. envia as imagens para o Artifact Registry;
5. conecta ao cluster GKE;
6. aplica os manifests Kubernetes;
7. atualiza as imagens dos Deployments.

### Variáveis do repositório

Configure em **Settings > Secrets and variables > Actions > Variables**:

- `GCP_PROJECT_ID`
- `GCP_REGION`
- `GKE_CLUSTER`
- `ARTIFACT_REGISTRY_REPOSITORY`

### Secret

Configure em **Settings > Secrets and variables > Actions > Secrets**:

- `GCP_SA_KEY` — chave JSON da Service Account usada pelo pipeline.

> O workflow só executa o deploy automático quando `GCP_PROJECT_ID` estiver configurado.

## Referência do desafio

Projeto desenvolvido a partir da proposta do módulo da DIO sobre Docker, Kubernetes, pipelines de deploy e Google Cloud.
