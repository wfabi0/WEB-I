# Sistema de Gerenciamento - Lanchonete Ota's

## 📋 Visão Geral

Sistema web de gerenciamento completo para uma lanchonete, desenvolvido em **PHP puro** com **MySQL**, implementando operações CRUD (Create, Read, Update, Delete) para três módulos principais: Funcionários, Produtos e Vendas.

O projeto foi desenvolvido com foco em **boas práticas de organização de código**, separação de responsabilidades e uma interface amigável ao usuário.

---

## 🛠️ Tecnologias Utilizadas

| Camada | Tecnologia | Versão |
|--------|-----------|--------|
| **Backend** | PHP | 7.4+ |
| **Banco de Dados** | MySQL | 5.7+ |
| **Frontend** | HTML5, CSS3 | - |
| **Client-Side** | JavaScript Vanilla | ES6+ |
| **Controle de Versão** | Git | - |

### Bibliotecas e Padrões
- **PDO (PHP Data Objects)**: Acesso ao banco de dados com prepared statements
- **Sessões PHP**: Autenticação e autorização
- **CSS Grid e Flexbox**: Layout responsivo

---

## 📁 Estrutura do Projeto

```
sistema-lanchonete-otas/
├── painel.php                          # Dashboard principal
├── login.php                           # Página de autenticação
├── sair.php                            # Logout
├── proteger.php                        # Middleware de validação de sessão
├── conexao.php                         # Camada de acesso a dados (DAL)
├── index.php                           # Entrada do sistema (se disponível)
│
├── painel/                             # Módulos de gerenciamento
│   ├── funcionarios.php                # Listar funcionários
│   ├── criar_funcionario.php           # Criar novo funcionário
│   ├── editar_funcionario.php          # Editar funcionário
│   ├── deletar_funcionario.php         # Deletar funcionário
│   │
│   ├── produtos.php                    # Listar produtos
│   ├── criar_produto.php               # Criar novo produto
│   ├── editar_produto.php              # Editar produto
│   ├── deletar_produto.php             # Deletar produto
│   │
│   ├── vendas.php                      # Listar vendas
│   ├── criar_venda.php                 # Criar venda com itens dinâmicos
│   ├── visualizar_venda.php            # Detalhar venda
│   └── deletar_venda.php               # Deletar venda
│
├── assets/
│   └── css/
│       ├── painel.css                  # Estilos gerais (header, footer, layout)
│       ├── crud.css                    # Estilos para tabelas e formulários
│       ├── login.css                   # Estilos da página de login
│       ├── venda.css                   # Estilos específicos da página de venda
│       └── visualizar_venda.css        # Estilos da visualização de venda
│
└── README.md                           # Este arquivo
```

---

## 🏗️ Arquitetura da Aplicação

### Padrão MVC Simplificado

A aplicação segue um padrão próximo ao MVC, mas de forma simplificada:

```
┌─────────────────────────────────────────────┐
│          CAMADA DE APRESENTAÇÃO             │
│  (Views - HTML/CSS/JavaScript)              │
│  painel.php, funcionarios.php, etc.         │
└────────────────┬────────────────────────────┘
                 │
┌────────────────▼────────────────────────────┐
│      CAMADA DE LÓGICA DE NEGÓCIO            │
│  (Controllers - PHP)                        │
│  Validações, processamento de formulários   │
└────────────────┬────────────────────────────┘
                 │
┌────────────────▼────────────────────────────┐
│    CAMADA DE ACESSO A DADOS (conexao.php)   │
│  (Models/DAL - Funções PHP)                 │
│  buscaTodosProdutos(), insereVenda(), etc.  │
└────────────────┬────────────────────────────┘
                 │
┌────────────────▼────────────────────────────┐
│           BANCO DE DADOS                    │
│  (MySQL)                                    │
│  Tabelas: funcionarios, produtos,           │
│  vendas, itens_venda                        │
└─────────────────────────────────────────────┘
```

### Fluxo de Autenticação

```
login.php
   ↓ (POST com email/senha)
conexao.php (validação no banco)
   ↓ (Se válido, cria sessão)
$_SESSION['funcionario_id'] e ['funcionario_nome']
   ↓
proteger.php (include em cada página)
   ↓ (Valida sessão)
painel.php (acesso permitido)
```

---

## 🗄️ Banco de Dados

### Diagrama de Entidades

```
┌─────────────────┐
│ FUNCIONARIOS    │
├─────────────────┤
│ id (PK)         │
│ nome            │
│ email (UNIQUE)  │
│ senha           │
│ data_criacao    │
└─────────────────┘
         │
         │ (FK)
         ├──────────────┐
         │              │
    ┌────▼──────────┐   │
    │ VENDAS        │   │
    ├───────────────┤   │
    │ id (PK)       │   │
    │ funcionario_id│───┼── (FK para FUNCIONARIOS)
    │ total         │   │
    │ data_venda    │   │
    └───┬──────────┘    │
        │               │
        │ (FK)          │
        │               │
    ┌───▼──────────────────┐
    │ ITENS_VENDA          │
    ├──────────────────────┤
    │ id (PK)              │
    │ venda_id (FK)        │
    │ produto_id (FK)      │
    │ quantidade           │
    │ preco_unitario       │
    │ subtotal             │
    └──────────┬───────────┘
               │
               │ (FK)
               │
        ┌──────▼──────────┐
        │ PRODUTOS        │
        ├─────────────────┤
        │ id (PK)         │
        │ nome            │
        │ descricao       │
        │ preco           │
        │ quantidade_est. │
        │ data_criacao    │
        └─────────────────┘
```

### Tabelas e Campos

#### **FUNCIONARIOS**
```sql
CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### **PRODUTOS**
```sql
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade_estoque INT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### **VENDAS**
```sql
CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    funcionario_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id)
);
```

#### **ITENS_VENDA**
```sql
CREATE TABLE itens_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (venda_id) REFERENCES vendas(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
```

---

## 🔐 Segurança e Validação

### Autenticação
- **Senha**: Armazenada com hash MD5 (⚠️ em produção, usar `password_hash()`)
- **Sessão**: Gerenciada pelo PHP
- **Proteção**: Arquivo `proteger.php` valida autenticação em todas as páginas

```php
// proteger.php - Exemplo
session_start();
if (!isset($_SESSION['funcionario_id'])) {
    header('Location: login.php');
    exit;
}
```

### Validação de Dados
- **HTML5**: Atributos `required`, `type="email"`, `min`, `step`
- **Server-side**: Validações PHP antes de inserir no banco
- **Exemplo** (criar_venda.php):
```php
if (item['quantidade'] > produto['quantidade_estoque']) {
    $mensagem = 'Produto não possui estoque suficiente!';
}
```

### Proteção contra SQL Injection
- ✅ **PDO Prepared Statements**: Usados em `conexao.php`
```php
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
```
- ⚠️ **Alguns riscos**: Há partes com interpolação de string que poderiam ser otimizadas

### XSS Prevention
- **htmlspecialchars()**: Usado em todas as saídas de usuário
```php
<?= htmlspecialchars($produto['nome']) ?>
```

---

## 🎯 Funcionalidades Principais

### 1. **Módulo de Funcionários**
- ✅ Listar todos os funcionários
- ✅ Criar novo funcionário
- ✅ Editar dados de funcionário
- ✅ Deletar funcionário

**Campos**: ID, Nome, Email, Data de Criação

### 2. **Módulo de Produtos**
- ✅ Listar todos os produtos
- ✅ Criar novo produto
- ✅ Editar produto
- ✅ Deletar produto
- ✅ Controle de estoque

**Campos**: ID, Nome, Descrição, Preço, Quantidade em Estoque, Datas

### 3. **Módulo de Vendas** ⭐
- ✅ Listar todas as vendas
- ✅ Criar venda com múltiplos itens
- ✅ Adicionar/remover itens dinamicamente (JavaScript)
- ✅ Cálculo automático de preço unitário, subtotal e total
- ✅ Validação de estoque antes de concluir
- ✅ Decréscimo automático do estoque ao vender
- ✅ Restauração de estoque ao deletar venda
- ✅ Visualizar detalhes de venda

**Recurso especial**: Sistema de itens dinâmicos com JavaScript puro

---

## 💻 Funcionalidades de JavaScript

### criar_venda.php - Sistema de Itens Dinâmicos

```javascript
// Atualiza cálculos em tempo real
function atualizarTotal() {
    // Para cada item adicionado:
    // 1. Busca o produto selecionado no array 'produtos'
    // 2. Converte preco de string para número (parseFloat)
    // 3. Atualiza preço unitário (read-only)
    // 4. Calcula subtotal = preço × quantidade
    // 5. Soma todos os subtotais para o total
}

// Adiciona nova linha de item dinamicamente
function adicionarItem() {
    // Cria novo elemento HTML
    // Incrementa contador de itens
    // Mantém consistência de nomes de inputs
}

// Remove item mantendo no mínimo 1 item
function removerItem(event) {
    // Encontra o .item-row mais próximo do botão
    // Remove elemento do DOM
    // Recalcula totais
}
```

**Desafio técnico resolvido**: Uso de CSS wildcard selectors (`name*=`) ao invés de índices diretos para encontrar inputs, permitindo remoção de itens sem quebrar os índices.

---

## 🎨 Interface de Usuário

### Design System
- **Paleta de cores**:
  - Primária: Orange (`#FF9500`)
  - Secundária: White (`#ffffff`)
  - Tertiary: Black (`rgba(0,0,0,0.85)`)

- **Layout**:
  - Flexbox para header e footer
  - CSS Grid para formulários e tabelas
  - Responsivo (mobile-first)

- **Componentes**:
  - Cards de menu
  - Tabelas com ações (editar/deletar)
  - Formulários estruturados
  - Alerts (success/error)
  - Grids dinâmicas

### Estrutura de Página Padrão

```html
<header>                    <!-- Navegação fixa -->
<div class="container">     <!-- Conteúdo principal -->
  <div class="page-header"> <!-- Título + Botões de ação -->
  <div class="form-container"> ou <div class="table-container">
</div>
<footer>                    <!-- Rodapé pegado no bottom -->
```

---

## 🔄 Fluxo de Uma Venda Completa

### Passo a Passo:

1. **Usuário acessa `/painel/vendas.php`**
   - Lista todas as vendas com totais e datas

2. **Clica em "Nova Venda"** → `/painel/criar_venda.php`
   - Carrega array de produtos em JavaScript
   - Exibe primeiro item vazio para seleção

3. **Seleciona um produto**
   - JavaScript dispara `atualizarTotal()`
   - Busca produto no array
   - Converte e exibe preço unitário (read-only)

4. **Digita quantidade**
   - JavaScript recalcula subtotal
   - Soma todos os itens para total

5. **Adiciona mais itens** (opcional)
   - Clica "Adicionar Item"
   - Nova linha é criada dinamicamente
   - Mesmo comportamento de cálculo

6. **Remove itens** (opcional)
   - Clica "Remover"
   - Item removido, totais recalculados
   - Mínimo de 1 item obrigatório

7. **Finaliza a venda**
   - PHP valida estoque novamente (server-side)
   - Insere venda em `VENDAS`
   - Insere itens em `ITENS_VENDA`
   - **Decrementa** quantidade em `PRODUTOS`
   - Mostra mensagem de sucesso

8. **Deleta uma venda** → `/painel/deletar_venda.php`
   - Remove registros de `ITENS_VENDA`
   - Remove registro de `VENDAS`
   - **Restaura** quantidade em `PRODUTOS`

---

## 🚀 Como Executar

### Requisitos
- PHP 7.4+
- MySQL 5.7+
- Servidor web (Apache, Nginx, etc.)

### Passos

1. **Clonar/Baixar projeto**
   ```bash
   git clone <url-do-repositorio>
   cd sistema-lanchonete-otas
   ```

2. **Configurar banco de dados**
   - Criar banco de dados no MySQL
   - Executar scripts SQL (tabelas fornecidas acima)
   - Atualizar credenciais em `conexao.php`

3. **Atualizar conexao.php**
   ```php
   $host = 'localhost';
   $db = 'seu_banco';
   $user = 'root';
   $pass = 'sua_senha';
   ```

4. **Acessar aplicação**
   ```
   http://localhost:8000  (ou seu servidor)
   ```

5. **Fazer login**
   - Email e senha do funcionário cadastrado

---

## 📊 Métricas e Complexidade

| Aspecto | Detalhes |
|---------|----------|
| **Linhas de código** | ~2000+ linhas (PHP + HTML + CSS + JS) |
| **Arquivos PHP** | 14 arquivos |
| **Arquivos CSS** | 5 arquivos |
| **Tabelas no BD** | 4 tabelas principais |
| **Funcionalidades CRUD** | 3 módulos × 4 operações = 12 funcionalidades |
| **Endpoints** | ~20 rotas diferentes |

---

## ⚠️ Limitações e Melhorias Futuras

### Limitações Atuais
1. **Segurança de Senha**: Usa MD5 (deveria ser `password_hash()`)
2. **Sem API REST**: Acesso apenas via formulários HTTP
3. **Sem testes unitários**: Código não possui testes
4. **Sem cache**: Queries executadas a cada requisição
5. **Sem logging**: Não há registro de ações dos usuários
6. **Validação**: Algumas validações apenas client-side

### Possíveis Melhorias
- [ ] Implementar hash bcrypt para senhas
- [ ] Criar API REST com JSON responses
- [ ] Adicionar testes com PHPUnit
- [ ] Implementar sistema de logs
- [ ] Adicionar relatórios em PDF
- [ ] Autenticação com 2FA
- [ ] Dashboard com gráficos de vendas
- [ ] Sistema de backup automático
- [ ] Deploy em container Docker

---

## 📝 Padrões de Código

### Nomenclatura
- **Funções de banco**: `buscaTodos*()`, `busca*()`, `insere*()`, `edita*()`, `deleta*()`
- **Classes CSS**: kebab-case (`.item-row`, `.btn-remove`)
- **Variáveis PHP**: camelCase (`$nomeFuncionario`, `$totalVenda`)

### Organização de Arquivos
- **Um arquivo por ação**: `criar_*.php`, `editar_*.php`, `deletar_*.php`
- **CSS separado por módulo**: `venda.css`, `visualizar_venda.css`
- **Lógica concentrada**: `conexao.php` centraliza todas as queries

### Padrão de Formulário
```php
1. Verificar REQUEST_METHOD
2. Validar dados
3. Chamar função de banco (conexao.php)
4. Exibir mensagem de sucesso/erro
5. Renderizar HTML/Formulário
```

---

## 🤔 Perguntas Esperadas do Professor

### Sobre Arquitetura
**P**: "Por que não usou um framework como Laravel?"
**R**: O projeto foi desenvolvido com PHP puro para demonstrar compreensão dos conceitos fundamentais: requisições HTTP, sessões, PDO, HTML forms, etc. Um framework abstrai muitos detalhes.

### Sobre Segurança
**P**: "Como protege contra SQL Injection?"
**R**: Utilizamos PDO prepared statements na maioria dos casos. Exemplo: `$stmt->execute([$id])` separa SQL da lógica.

**P**: "E sobre XSS?"
**R**: Todas as saídas dinâmicas usam `htmlspecialchars()` para escapar caracteres especiais.

### Sobre Banco de Dados
**P**: "Por que criou a tabela ITENS_VENDA separada?"
**R**: Normalização. Uma venda pode ter múltiplos itens. Separar em tabela evita repetição de dados e permite queries mais eficientes.

**P**: "Como garante que o estoque não fica negativo?"
**R**: Validação server-side compara quantidade vendida com `quantidade_estoque`. Se insuficiente, transação não ocorre.

### Sobre JavaScript
**P**: "Por que usou JavaScript puro em vez de bibliotecas como jQuery?"
**R**: Para demonstrar compreensão de JavaScript vanilla, DOM manipulation, event listeners e fetch API moderna.

**P**: "Como resolve o problema de índices ao remover itens?"
**R**: Inicialmente usávamos índices diretos que quebrava ao remover. Mudei para CSS wildcard selectors (`name*=`) que encontram inputs por padrão de nome.

### Sobre UX/UI
**P**: "Como trata a adição dinâmica de itens?"
**R**: Via JavaScript `createElement()` para criar linha HTML nova. Cada item mantém referência única via `itemCount` incrementado. Cálculos são feitos em tempo real.

---

## 📚 Recursos Técnicos Utilizados

- [PDO - PHP Data Objects](https://www.php.net/manual/pt_BR/book.pdo.php)
- [CSS Grid](https://developer.mozilla.org/pt-BR/docs/Web/CSS/CSS_Grid_Layout)
- [JavaScript DOM API](https://developer.mozilla.org/pt-BR/docs/Web/API/Document_Object_Model)
- [MySQL Foreign Keys](https://dev.mysql.com/doc/)
- [PHP Sessions](https://www.php.net/manual/pt_BR/book.session.php)