var canvas = document.getElementById('canvas_sineCosine');

console.log(canvas);

canvas.height = 350;
canvas.width = 350;

var c = canvas.getContext('2d');
c.font = "16px Arial";

c.fillRect(0, 0, 100, 100);

var ox = canvas.width / 2;
var oy = canvas.height / 2;

//c.translate(ox, oy);

theta = 0;



requestAnimationFrame(animate)
function animate(currentTime)
{

  c.clearRect(0, 0, canvas.width, canvas.height);

  //Increase by 1 degree
  theta -= (Math.PI / 180)

  var newX = Math.cos(theta) * 150;
  var newY = Math.sin(theta) * 150;

  //Draw the real component
  c.lineWidth = 2;
  c.strokeStyle = "red";
  c.beginPath();
  c.moveTo(ox, oy);
  c.lineTo(ox + newX, oy);
  c.stroke();

  //Draw the real component
  c.lineWidth = 2;
  c.strokeStyle = "green";
  c.beginPath();
  c.moveTo(ox, oy);
  c.lineTo(ox, oy + newY);
  c.stroke();

  //Draw the imaginary component
  c.lineWidth = 2;
  c.strokeStyle = "black";
  c.beginPath();
  c.moveTo(ox, oy);
  c.lineTo(ox + newX, oy + newY);
  c.stroke();

  //Draw the connecting line
  c.lineWidth = 2;
  c.strokeStyle = "green";
  c.beginPath();
  c.moveTo(ox + newX, oy);
  c.lineTo(ox + newX, oy + newY);
  c.stroke();

  //Draw the connecting line
  c.lineWidth = 2;
  c.strokeStyle = "red";
  c.beginPath();
  c.moveTo(ox, oy + newY);
  c.lineTo(ox + newX, oy + newY);
  c.stroke();

  c.fillStyle = 'black';
  c.beginPath();
  c.arc(ox, oy, 5, 0, 2*Math.PI, false);
  c.fill();

  c.strokeStyle = 'black';
  c.beginPath();
  c.arc(ox, oy, 150, 0, 2*Math.PI, false);
  c.stroke();


  requestAnimationFrame(animate)
}



function bresenhamLine(x, y, xx, yy){
var oldFill = c.fillStyle; // save old fill style
c.fillStyle = c.strokeStyle; // move stroke style to fill
xx = Math.floor(xx);
yy = Math.floor(yy);
x = Math.floor(x);
y = Math.floor(y);
// BRENSENHAM
var dx = Math.abs(xx-x);
var sx = x < xx ? 1 : -1;
var dy = -Math.abs(yy-y);
var sy = y<yy ? 1 : -1;
var err = dx+dy;
var errC; // error value
var end = false;
var x1 = x;
var y1 = y;
while(!end){
c.fillRect(x1, y1, 1, 1); // draw each pixel as a rect
if (x1 === xx && y1 === yy) {
end = true;
}else{
errC = 2*err;
if (errC >= dy) {
err += dy;
x1 += sx;
}
if (errC <= dx) {
err += dx;
y1 += sy;
}
}
}
c.fillStyle = oldFill; // restore old fill style
}
