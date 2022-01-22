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
    var countedSymbol = lines[0].split('+');
    var result = 0;
    countedSymbol.forEach(function(symbol){
        var Symbol1 = "/" ;
        var Symbol2 = "<" ;
        var countSymbol1 = (symbol.match(new RegExp(Symbol1,"g"))||[]).length;
        var countSymbol2 = (symbol.match(new RegExp(Symbol2,"g"))||[]).length;
        var calSymbols = countSymbol2 * 10 + countSymbol1
        result += calSymbols;
    });
    console.log(result);
});