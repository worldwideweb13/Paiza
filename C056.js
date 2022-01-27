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
   const dataSet = lines.slice(1).map(el=>el.split(' ').map(Number));
    //合格点をlinesから抜き出す
   const passingScore = Math.floor(lines[0].split(' ').pop(0));
   for(let i=0; i< dataSet.length; i++){
      studentScore = dataSet[i][0];
      absentScore = dataSet[i][1] * 5;
      result = studentScore - absentScore;
    //   成績が0点を下回る時(マイナス値)は0点とみなす
      if (result < 0){
          result = 0;
      }
      if(result >= passingScore){
          console.log(i+1);
      }
   }

});