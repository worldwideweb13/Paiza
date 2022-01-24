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
// .replaceをメソッドチェーンを使って、複数文字列の置換をする
  Converter = lines[0].replace(/A/g, 4)
                      .replace(/E/g, 3)
                      .replace(/G/g, 6)
                      .replace(/I/g, 1)
                      .replace(/O/g, 0)
                      .replace(/S/g, 5)
                      .replace(/Z/g, 2)
  console.log(Converter);
});