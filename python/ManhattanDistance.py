# マンハッタン距離...マス目問題。ある2点の最短距離に位置する座標を求める
# 以下のケースを想定 
#      N H W P Q        R_H 7 6 4 4 
#      R_1              RRRRRR
#      R_2              R....R
#      ...              R.RR.R
#      R_H              R.R○.R
#                       R.RRRR
#                       R.....
#                       RRRRRR
# ○の位置(4,4)から最短距離にある"."の座標を画面に出力
# Rは含まない


from collections import deque
from operator import itemgetter


# (1) 座席の二次元配列を作成...massArr[0:{x:0,y:0,val:0},1:{}...]
N,H,W,P,Q = map(int,input().split())
massArr = []
for x in range(H):
    rowArr = []
    for y in range(W):
        mass = {'x':x,'y':y,'val':0}
        rowArr.append(mass)
    massArr.append(rowArr)

# (2) massArrの内、予約済み座標(R)のvalを999（999 = 予約済）に置き換える
for _ in range(N):
    x,y = map(int,input().split())
    massArr[x][y]["val"] = 999

# (3-1) ◯の位置から,幅優先探索で各マスの最短距離をmassArrのvalに入れる
#       ※ その時、valが999の箇所は555に置き換え(555 = 探索済)
ansArr = []
val = 1
positions = deque()
positions.append({'x':P,'y':Q,'val': massArr[P][Q]["val"] })

# マンハッタン距離がゼロの時は探索させずに終了
if massArr[P][Q]["val"] == 0:
    ansArr.append({'x':P,'y':Q,'val':0})
    
# 関数のセット
def checkLoad(massArr,positions,ansArr,H,W,P,Q):
    dx = (0,1,0,-1)
    dy = (1,0,-1,0)
    nposition = deque()
    while(len(positions) > 0):
        position = positions.popleft()
        for di in range(4):
            nx = position["x"] + dx[di]
            ny = position["y"] + dy[di]
            if(nx < 0 or nx >= H or ny < 0 or ny >= W or massArr[nx][ny]['val'] == 555): 
                continue
            elif(massArr[nx][ny]['val'] == 0):
                ansArr.append({'x':nx, 'y':ny, 'val':abs(P - nx) + abs(Q - ny) })
            else:
                nposition.append({'x':nx, 'y':ny, 'val':massArr[nx][ny]['val'] })
            massArr[nx][ny]['val'] = 555
            
    positions = nposition
    return positions,ansArr

while(len(ansArr) == 0):
    positions,ansArr = checkLoad(massArr,positions,ansArr,H,W,P,Q)

# 解答結果の出力...第1 → x,第２ → y でリスト昇順に変更して画面に出力
for ans in sorted(ansArr, key=itemgetter('x', 'y')):
    print(ans['x'],ans['y'])
    