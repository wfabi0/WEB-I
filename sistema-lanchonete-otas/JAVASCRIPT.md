# 📍 Localização de JavaScript no Projeto

## Resumo

Todo o código JavaScript foi separado em arquivos na pasta `/assets/js/` para melhor organização e manutenibilidade.

## 📂 Arquivos JavaScript

### `assets/js/venda.js`
**Propósito**: Gerenciar o sistema dinâmico de itens da página de criar venda

**Usado em**: 
- `painel/criar_venda.php`

**Funções**:
- `atualizarTotal()` - Calcula preço unitário, subtotal e total em tempo real
- `adicionarItem()` - Adiciona nova linha de item dinamicamente
- `removerItem(event)` - Remove item mantendo mínimo de 1

**Detalhes técnicos**:
- Converte preço de string para número com `parseFloat()`
- Usa CSS wildcard selectors (`name*=`) para encontrar inputs
- Dispara cálculos em `onchange` e `oninput` dos selects e inputs
- Passa dados de produtos do PHP via `window.produtosGlobais`

---

### `assets/js/utils.js`
**Propósito**: Utilitários gerais (confirmações)

**Usado em**:
- `painel/funcionarios.php`
- `painel/produtos.php`
- `painel/vendas.php`

**Funções**:
- `confirmarDelecao(mensagem)` - Confirmação genérica
- `ConfirmacaoUtils.deletarFuncionario()` - Confirma delete de funcionário
- `ConfirmacaoUtils.deletarProduto()` - Confirma delete de produto
- `ConfirmacaoUtils.deletarVenda()` - Confirma delete de venda

---

## 🔗 Referências nos HTML

### criar_venda.php
```html
<script>
    // Passa produtos do PHP para JavaScript
    window.produtosGlobais = <?= json_encode($produtos); ?>;
</script>
<script src="../assets/js/venda.js"></script>
```

### funcionarios.php
```html
<script src="../assets/js/utils.js"></script>
```

### produtos.php
```html
<script src="../assets/js/utils.js"></script>
```

### vendas.php
```html
<script src="../assets/js/utils.js"></script>
```

---

## 📊 Uso de Event Handlers (Inline)

Ainda há alguns `onclick` inline nos HTML por questões de simplicidade:

| Arquivo | Tipo | Função |
|---------|------|--------|
| `criar_venda.php` | onchange, oninput | `atualizarTotal()` |
| `criar_venda.php` | onclick | `adicionarItem()`, `removerItem(event)` |
| `funcionarios.php` | onclick | `confirm()` |
| `produtos.php` | onclick | `confirm()` |
| `vendas.php` | onclick | `confirm()` |

---

## 🚀 Estrutura de Pastas Atualizada

```
assets/
├── css/
│   ├── painel.css
│   ├── crud.css
│   ├── login.css
│   ├── venda.css
│   └── visualizar_venda.css
│
└── js/                    ← NOVO
    ├── venda.js           (Gerenciar itens de venda)
    └── utils.js           (Confirmações gerais)
```

---

## 💡 Observações

1. **Event handlers inline vs externos**:
   - Mantemos `onclick`, `onchange`, `oninput` inline para simplicidade
   - As funções chamadas estão todas em `/assets/js/`

2. **Escopo global**:
   - `window.produtosGlobais` - Disponibiliza dados PHP no JS
   - Funções globais chamadas diretamente: `atualizarTotal()`, `adicionarItem()`, etc.

3. **Carregamento**:
   - Scripts carregados no final do `</body>` para melhor performance
   - Uso de `DOMContentLoaded` para garantir que DOM está pronto

4. **Localização relativa**:
   - De `painel/criar_venda.php` para `../assets/js/venda.js`
   - De `painel/funcionarios.php` para `../assets/js/utils.js`

---

## ✅ Checklist de Conversão

- [x] `venda.js` - Sistema dinâmico de itens
- [x] `utils.js` - Confirmações gerais
- [x] `criar_venda.php` - Atualizado com `window.produtosGlobais`
- [x] `funcionarios.php` - Link para utils.js
- [x] `produtos.php` - Link para utils.js
- [x] `vendas.php` - Link para utils.js
