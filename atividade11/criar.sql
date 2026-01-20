CREATE TABLE IF NOT EXISTS `alunos` (
  `ra` VARCHAR(7) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL,
  `pagamento` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`ra`)
);