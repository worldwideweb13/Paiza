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
    // 移動距離
    const goalDistance = lines[0].split(' ')[1];
    // {[初乗り距離:x,初乗り料金:y,加算距離:xx,加算料金:yy]}の連想配列を作成
    let dataSet = [];
    const sliceData = lines.slice(1).map(el => el.split(' ').map(Number));
    sliceData.forEach(function(el){
        let taxiData = {};
        taxiData.firstDistance = el[0];
        taxiData.firstPrice = el[1];
        taxiData.addDistance = el[2];
        taxiData.addPrice = el[3];
        dataSet.push(taxiData);
    });
    
    // 連想配列taxiDataに[result : 計算結果] を追加
    dataSet.forEach(function(el){
        // 移動距離  - 初乗り距離 = 加算距離を算出
        var calDistance = goalDistance - el.firstDistance;
        // 初乗り料金内に収まる場合は、初乗り料金 = 乗車料金
        // ※初乗り距離 = 移動距離の場合は加算料金1回分が発生 <=-1 を条件とする
        if(calDistance <= -1){
            el.result = el.firstPrice;
            return;
        }
        var priceCount = Math.floor(calDistance / el.addDistance);
        if( priceCount >= 1 ){
            priceCount += 1;
        } else if(priceCount === 0){
            priceCount = 1;
        }
        el.result = priceCount * el.addPrice +  el.firstPrice;
    });
    // 最小額
    const minResult =  dataSet.reduce((a,b)=>a.result < b.result ? a:b).result;
    // 最大額
    const maxResult =  dataSet.reduce((a,b)=>a.result > b.result ? a:b).result;    
    console.log(minResult + " " + maxResult);
});