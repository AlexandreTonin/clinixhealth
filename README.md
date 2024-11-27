# Guia de Execução dos Projetos

Este guia explica os passos necessários para rodar os três componentes da aplicação: a API REST em Node.js, a API SOAP em PHP e o Apache Camel.

---

## 1. **API REST (Node.js)**

Para rodar a API REST, siga os passos abaixo:

1. **Instalar o Node.js**:
   - Baixe e instale o **Node.js versão 23.3.0** (certifique-se de instalar essa versão específica).
   - Link: [Download Node.js 23.3.0](https://nodejs.org/dist/v23.3.0/).

2. **Acessar a pasta do projeto**:
   - Navegue até a pasta **api-rest** no terminal.

3. **Instalar dependências**:
   - Execute o comando para instalar as dependências do projeto:
     ```bash
     npm install
     ```

4. **Rodar a aplicação**:
   - Para iniciar a API, execute:
     ```bash
     npm run start
     ```

---

## 2. **API SOAP (PHP)**

Para rodar a API SOAP, siga os passos abaixo:

1. **Instalar o XAMPP**:
   - Baixe e instale o **XAMPP** na versão mais recente.
   - Link: [Download XAMPP](https://www.apachefriends.org/index.html).

2. **Configurar o XAMPP**:
   - Durante a instalação, certifique-se de selecionar as opções **PHP**, **MySQL** e **Apache**.

3. **Colocar o projeto PHP**:
   - Coloque a pasta do projeto PHP dentro da pasta **htdocs** do XAMPP (normalmente localizada em `C:\xampp\htdocs`).

4. **Iniciar os serviços**:
   - Abra o painel de controle do XAMPP e inicie os serviços do **Apache** e **MySQL**.

5. **Acessar o projeto**:
   - No navegador, acesse o sistema da clínica através do seguinte endereço:
     ```bash
     http://localhost/sistema-da-clinica/
     ```

---

## 3. **Apache Camel**

Para rodar o Apache Camel, siga os passos abaixo:

1. **Instalar o JDK 17**:
   - Baixe e instale o **JDK 17**.
   - Link: [Download JDK 17](https://jdk.java.net/17/).

2. **Instalar o Maven**:
   - Baixe e instale o **Maven**.
   - Link: [Download Maven](https://maven.apache.org/download.cgi).
   - Certifique-se de configurar o **Maven** nas variáveis de ambiente do sistema para poder usá-lo de qualquer diretório no terminal.

3. **Acessar a pasta do projeto**:
   - Navegue até a pasta do projeto **apacheCamel** no terminal.

4. **Instalar dependências e compilar o projeto**:
   - Execute o comando para limpar o projeto e instalar as dependências:
     ```bash
     mvn clean install
     ```

5. **Rodar o projeto**:
   - Para executar o Apache Camel, execute o seguinte comando:
     ```bash
     mvn exec:java
     ```

---

### Observações Finais

- Certifique-se de ter as versões específicas de cada software, conforme mencionado, para evitar incompatibilidades.
- Caso tenha algum erro ou problema, verifique os logs e mensagens de erro no terminal ou nos serviços do XAMPP.
- Para mais informações sobre cada ferramenta, consulte a documentação oficial dos respectivos projetos.
