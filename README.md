# Server Monitor Agent

Este é um agente de coleta de métricas de servidor, desenvolvido em PHP. O agente coleta informações vitais do servidor e as envia para uma API central para monitoramento e análise.

## Funcionalidades

- Coleta de métricas de CPU.
- Coleta de métricas de uso de disco.
- Coleta de métricas de memória RAM.
- Coleta de tempo de atividade (uptime) do servidor.
- Envio das métricas para uma API central.

## Requisitos

- PHP >= 8.3
- Composer

## Como Instalar

1. Clone o repositório:
   ```bash
   git clone https://github.com/lucastakeshi/server-monitor-agent.git
   cd server-monitor-agent
   ```

2. Instale as dependências com o Composer:
   ```bash
   composer install
   ```

## Como Configurar

1. Crie um arquivo de ambiente `.env` a partir do exemplo:
   ```bash
   cp .env.example .env
   ```

2. Edite o arquivo `.env` com as suas configurações:
   ```dotenv
   BASE_URL="http://sua-api-laravel.com/api"
   API_KEY="seu-token-de-api"
   ```

## Como Executar

Para executar o agente e enviar as métricas para a API, execute o seguinte comando:

```bash
php agent.php
```

### Executando os Testes

O projeto possui testes unitários e ferramentas de qualidade de código. Para executar os testes, utilize os seguintes comandos:

- **Pint (Code Style):**
  ```bash
  composer test:pint
  ```

- **Rector (Refatoração):**
  ```bash
  composer test:rector
  ```

- **PHPUnit (Testes Unitários):**
  ```bash
  composer test:unit
  ```

- **Executar todos os testes:**
  ```bash
  composer tests
  ```

## Funcionalidade Detalhada

O agente é executado através do arquivo `agent.php`. Ele inicializa os coletores de métricas, que são responsáveis por obter as seguintes informações:

- **CpuCollector:** Coleta o uso da CPU.
- **DiskCollector:** Coleta o espaço total e o espaço livre em disco.
- **MemoryCollector:** Coleta a memória total e a memória livre.
- **UptimeCollector:** Coleta o tempo de atividade do servidor.

Após a coleta, as informações são enviadas para a API configurada no arquivo `.env`. A comunicação com a API é feita através do Guzzle.

## Tecnologias Utilizadas

- **PHP 8.3**
- **Guzzle:** Cliente HTTP para comunicação com a API.
- **PHPUnit:** Para testes unitários.
- **Pint:** Para padronização do estilo de código.
- **Rector:** Para refatoração automatizada.
- **PHPStan:** Para análise estática de código.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
