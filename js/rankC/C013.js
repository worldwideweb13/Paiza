process.stdin.resume();
process.stdin.setEncoding('utf8');
// 自分の得意な言語で
// Let's チャレンジ！！
var lines = [];
var reader = require('readline').createInterface({
  input: process.stdin,
  output: process.stdout
});
reader.on('line', (line) => {
  lines.push(line);
});
reader.on('close', () => {
    // var disLikeNum = Number(lines[0]);
    // var RoomNum = lines.slice(2).map(Number);
    var disLikeNum = lines[0];
    var RoomNum = lines.slice(2);
    var Count = 0;
    RoomNum.forEach(function(el){
        regexp = new RegExp(disLikeNum);
        if(el.match(regexp)){
            Count++;
            return;
        }else{
            console.log(el);
        }
    });

    if(Count == RoomNum.length){
        console.log("none");
    }
    
    // console.log(result);
    
});