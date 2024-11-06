<?php 
require 'db_conn.php';  
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Tarefas</title>
    <h1>LISTA DE TAREFAS</h1>
 
   
 
    <link rel="stylesheet" href="css/style.css">
     
</head>
<body>
    <div class="main-section">
       <div class="add-section">
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" 
                     name="titulo" 
                     style="border-color: #ff6666"
                     placeholder="Este campo é obrigatório" />
              <button type="submit">Adicionar &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text" 
                     name="titulo" 
                     placeholder="Escreva a Tarefa " />
              <button type="submit">Adicionar &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
       </div>
       <?php 
          $lista = $conn->query("SELECT * FROM lista ORDER BY id DESC");
       ?>
       <div class="show-todo-section">
            <?php if($lista->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/lista-de-ta.jpeg" width="100%" />
                        <img src="img/espera.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $lista->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checado']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['titulo'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-lista-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['titulo'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>Criado Em: <?php echo $todo['data_hora'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-lista-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checado');
                              }else {
                                  h2.addClass('checado');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>