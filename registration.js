const skin = ["green.png","red.png","yellow.png"];
const eyes =  ["closed.png","laughing.png","long.png","normal.png","rolling.png","winking.png"];
const mouth = ["open.png","sad.png","smiling.png","straight.png","surprised.png","teeth.png"];
let skin_index = 1;
let eyes_index = 1;
let mouth_index = 1;

function change_skin(index) {
    var image = document.getElementById('skin');
    skin_index = skin_index+index;
    image.src = "assets/emoji-assets/skin/"+skin_index;
    console.write   
}

