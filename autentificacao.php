<?php

function checkLogged($pdo)
{
  // Verifica se as variáveis de sessão criadas
  // no momento do login estão definidas
  if (!isset($_SESSION['emailUsuario'], $_SESSION['loginString'])) return false;
  else return true;
}

function exitWhenNotLogged($pdo)
{
  if (!checkLogged($pdo)) {
    header("Location: ../index.html");
    exit();
  }
}