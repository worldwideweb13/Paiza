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
    // 回答方針
    // [1] 必要な値を変数/配列化する。置換回数(count),暗号文(codeText),暗号ルール(codeRule),アルファベット(alphabet)
    // [2] 暗号文を一文字ずつ置換ルールと比較。暗号文文字=暗号ルールとなる時の、置換ルールの文字列順を取得
    // [3] [2]で取得した番号のアルファベット文字列を取得する。
    // [4] [2][3]を暗号文の文字列回数分繰り返す
    // [5] [2][3][4]の処理を置換回数(count)回、繰り返す。
    // [5]で得られた文字列を表示する
    
    const alphabet = "abcdefghijklmnopqrstuvwxyz";
    const count = lines[0].split(' ')[0];
    const codeRule = lines[0].split(' ')[1];
    let codeText = lines[1];
    let Decryption = '';
    
    for(let c = 0;c < count;c++){
        // 暗号文(codeText)の文字列を一つずつ取り出して以下の処理を実行
        for(let i=0;i < codeText.length;i++){
            // 半角スペースは、置換え後文字列に反映させる
            if(codeText.charAt(i) === ' '){
                Decryption += ' ';
                continue;
            }
            for(let n=0;n < codeRule.length; n++){
                if(codeText.charAt(i) === codeRule.charAt((n))){
                    Decryption += alphabet.charAt(n);
                }
            }
        }
        codeText = Decryption;
        Decryption = '';
    }
    console.log(codeText);
});