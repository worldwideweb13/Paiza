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
    // holiDay = 連休の日数
    const holiday = Math.floor(lines[0].split(' ')[0]);
    // holiDay = 旅行の日数
    const tripDay = Math.floor(lines[0].split(' ')[1]);
    
    
    // linesを[[連休の日付,降水確率]]に加工  cf, [[ 3, 30 ], [ 4, 25 ],]
    const linesDataSet = lines.slice(1).map(el => el.split(' ').map(Number));
    // DataSet = [{連休の日付:降水確率}]に加工
    let DataSet = [];
    linesDataSet.forEach(function(el){
        key = el[0];
        value = el[1];
        var data = {[key]:value};
        DataSet.push(data)
    });
    
    // result = [{day:期待する出力(cf 3 6)},{average:休暇期間内の工数確率の平均値}]に加工
    let result = [];
    let indexStart = 0;
    let indexEnd = tripDay;

    for(let i = 0;i <= holiday - tripDay; i++){
        
        // 降水確率の平均for文内で利用。for文開始前に毎回初期化。
        let average = 0;
        for(indexStart;indexStart < indexEnd; indexStart++){
            var DataSetIndex = Object.keys(DataSet[indexStart]);
            average += DataSet[indexStart][DataSetIndex];
        }
        let startDay =  Object.keys(DataSet[i]);
        let endDay = Object.keys(DataSet[indexEnd -1]);
        let day = startDay + " " + endDay;
        average = Math.floor(average / 3);
        let calcResult = {};
        calcResult["result"] = day;
        calcResult["average"] = average;
        result.push(calcResult);
        indexStart = indexStart - tripDay;
        indexStart++;
        indexEnd++;
    }
    const minAverage = Math.min(...result.map((el) => el.average));
    var index = result.findIndex(el => el.average === minAverage );
    console.log(result[index]["result"]);
});