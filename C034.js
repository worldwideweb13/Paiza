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
    const factors = lines[0].split(' ');
    let operator = factors[1];
    let numbers = [factors[0],factors[2],factors[4]];
    const xIndex = numbers.findIndex(n => n == "x");
    numbers = numbers.filter(n => n != "x").map(Number);
    // console.log(numbers);
    // console.log(xIndex);
    // console.log(operator);
    
    // x が先頭で符号が＋の時,例:x + 3 = 6
    if(xIndex === 0 && operator == "+"){
        answer = numbers[1] - numbers[0];
        console.log(answer);        
    }
    // x が先頭で符号が-の時,例:x - 3 = 6
    if(xIndex === 0 && operator == "-"){
        answer = numbers[0] + numbers[1];
        console.log(answer);
    }
    // x が2番目で符号が＋の時,例:3 + x = 6
    if(xIndex === 1 && operator == "+"){
        answer = numbers[1] - numbers[0];
        console.log(answer);
    }
    // x が2番目で符号が-の時,例:3 - x = 1
    if(xIndex === 1 && operator == "-"){
        answer = numbers[0] - numbers[1];
        console.log(answer);
    } 

    // x が3番目で符号が＋の時,例:3 + 2 = x
    if(xIndex === 2 && operator === "+"){
        answer = numbers[0] + numbers[1]
        console.log(answer);
    }     
    
    // x が3番目で符号が-の時,例:3 - 2 = x
    if(xIndex === 2 && operator === "-"){
        answer = numbers[0] - numbers[1]
        console.log(answer);
        return;
    }

});