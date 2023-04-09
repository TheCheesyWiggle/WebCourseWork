const skin = ["green.png","red.png","yellow.png"];
const eyes =  ["closed.png","laughing.png","long.png","normal.png","rolling.png","winking.png"];
const mouth = ["open.png","sad.png","smiling.png","straight.png","surprised.png","teeth.png"];
let skin_index = 1;
let eyes_index = 1;
let mouth_index = 1;

function add_image_s() {
    var img = new Image();
    img.src = "assets/emoji-assets/skin"+ skin[skin_index];
    document.getElementById('emoji').appendChild(img);
    down.innerHTML = "Image Element Added.";
}
function add_image_e() {
    var img = new Image();
    img.src = "assets/emoji-assets/skin"+ skin[skin_index];
    document.getElementById('emoji').appendChild(img);
}
function add_image_m() {
    var img = new Image();
    img.src = "assets/emoji-assets/skin"+ skin[skin_index];
    document.getElementById('emoji').appendChild(img);
}