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
    const requestedDigit = lines.slice(1).map(Number);
    // console.log(requestedDigit);
    let answerNumber = [];
    // 問題の１０進数の整数を２進数に変換してanswerNumberに配列型式で格納
    let decimalNumber = Math.floor(lines[0].split(' ').pop(0));
    do {
        number = decimalNumber % 2;
        // console.log(number);
        decimalNumber = Math.floor(decimalNumber / 2);
        // console.log(decimalNumber);
        answerNumber.push(number);
        // console.log(answerNumber);
    } while (decimalNumber !== 0);
    // console.log(answerNumber);
    // console.log(requestedDigit);
    // 指定された桁をanswerNumberから引き出す
    requestedDigit.forEach(function(el){
        // console.log(el);
        console.log(answerNumber[el-1]);
    });
});
