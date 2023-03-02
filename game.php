<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/game.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <title>Project ΚαΠα</title>
    <script src="game.js" defer></script>
</head>
<body>
<section class="score">
    <span class="correct">0</span>/<span class="total">0</span>
    <button id="play-again-btn">Play Again</button>
</section>
<div class="bag" >
    <img src="imgs/background.png" draggable="false">
    <i class="draggable draggable1" draggable="true"><img src="imgs/lit1.png" alt="1" id="recycle1"></i> 
    <i class="draggable draggable2" draggable="true"><img src="imgs/lit2.png" alt="2" id="recycle2"></i>
    <i class="draggable draggable3" draggable="true"><img src="imgs/lit3.png" alt="3" id="recycle3"></i>
    <i class="draggable draggable4" draggable="true"><img src="imgs/lit4.png" alt="4" id="compost1"></i>
    <i class="draggable draggable5" draggable="true"><img src="imgs/lit5.png" alt="5" id="compost2"></i>
    <i class="draggable draggable6" draggable="true"><img src="imgs/lit6.png" alt="6" id="trash"></i>
    <i class="draggable draggable7" draggable="true"><img src="imgs/lit7.png" alt="7" id="paper"></i> 
      

    <div class="droppable droppable1" ><img src="imgs/trash1.png" id="recycle"draggable="false"></div>
    <div class="droppable droppable2" ><img src="imgs/trash2.png" id="paper" draggable="false"></div>
    <div class="droppable droppable3" ><img src="imgs/trash3.png" id="trash" draggable="false"></div>
    <div class="droppable droppable4" ><img src="imgs/trash4.png" id="compost"draggable="false"></div>


</div>
    
</body>
</html>