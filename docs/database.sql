CREATE TABLE tbl_student(
 sid CHAR(5) PRIMARY KEY, -- 学籍番号
 sname VARCHAR(16) NOT NULL, -- 氏名
 sex INT, -- 性別
 tel VARCHAR(32), -- 電話番号
 email VARCHAR(64), -- メールアドレス
 credit INT, -- 修得単位数
 gpa FLOAT, -- GPA
 decided INT -- 配属決定（1,2-プログラム番号、0-未配属）
);

CREATE TABLE tbl_program(
 pid INT PRIMARY KEY, -- プログラム番号
 pname VARCHAR(16) NOT NULL, -- プログラム名
 detail TEXT, -- プログラム紹介
 reqirement TEXT -- 登録要件
);

CREATE TABLE tbl_wish(
 sid CHAR(5) PRIMARY KEY, -- 学籍番号
 pid INT NOT NULL, -- 希望プログラム番号
 reason TEXT, -- 希望理由
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- 登録時刻
);

CREATE TABLE tbl_user(
 uid VARCHAR(16) PRIMARY KEY, -- ユーザID
 uname VARCHAR(32) NOT NULL, -- ユーザ名
 upass VARCHAR(16) NOT NULL, -- パスワード
 urole INT -- ユーザ種別
);

INSERT INTO tbl_student VALUES
('S0001','斎藤 唯人', 1,'090-5918-5777','s0001@st.kyusan-u.ac.jp',29,3.93,0),
('S0002','谷口 志穂', 2,'090-1935-5508','s0002@st.kyusan-u.ac.jp',23,1.89,0),
('S0003','吉村 琉翔', 1,'090-2300-9542','s0003@st.kyusan-u.ac.jp',37,3.35,0),
('S0004','永井 涼平', 1,'090-1935-5508','s0004@st.kyusan-u.ac.jp',41,3.19,0),
('S0005','内田 真之介',1,'090-8055-6286','s0005@st.kyusan-u.ac.jp',36,1.58,0),
('S0006','村上 まゆみ',2,'090-5918-5779','s0006@st.kyusan-u.ac.jp',44,2.41,0),
('S0007','古川 凛太朗',1,'090-0441-9923','s0007@st.kyusan-u.ac.jp',28,2.16,0),
('S0008','安田 遙斗', 1,'090-2625-6453','s0008@st.kyusan-u.ac.jp',47,1.37,0),
('S0009','内田 結奈', 2,'090-8055-6286','s0009@st.kyusan-u.ac.jp',46,3.63,0),
('S0010','片山 玲音', 1,'090-0808-0949','s0010@st.kyusan-u.ac.jp',45,2.49,0),
('S0011','川口 耕平', 1,'090-6929-6453','s0011@st.kyusan-u.ac.jp',34,2.74,0),
('S0012','伊藤 亮平', 1,'090-7069-6114','s0012@st.kyusan-u.ac.jp',45,3.64,0),
('S0013','菊池 英寿', 1,'090-3465-8946','s0013@st.kyusan-u.ac.jp',36,2.83,0),
('S0014','横田 駿太', 1,'090-9713-6390','s0014@st.kyusan-u.ac.jp',44,2.49,0),
('S0015','増田 隼翔', 1,'090-4390-2387','s0015@st.kyusan-u.ac.jp',29,2.64,0),
('S0016','今井 隆一', 1,'090-9635-5073','s0016@st.kyusan-u.ac.jp',26,3.38,0),
('S0017','濱田 陽斗', 1,'090-9283-7276','s0017@st.kyusan-u.ac.jp',27,2.42,0),
('S0018','阿部 絢', 2,'090-3417-2063','s0018@st.kyusan-u.ac.jp',30,3.19,0),
('S0019','柴田 智貴', 1,'090-3756-9936','s0019@st.kyusan-u.ac.jp',44,3.21,0),
('S0020','望月 陽菜子',2,'090-2300-9542','s0020@st.kyusan-u.ac.jp',47,3.54,0);

INSERT INTO tbl_program VALUES
(1, '総合教育プログラム', '情報科学・情報技術を基礎から総合的に学んだ上で、履修モデルの中から興味・適性のある情報技術および適用分野を選択するプログラム。', '情報科学総合プログラムに登録するには、１年次終了までに、次の各号に掲げる要件を満たさなければならない。（１）1年次に配当されている授業科目を38単位以上修得していること。（２）GPAが2.0以上であること。'),
(2, '応用教育プログラム', '履修モデルの中から興味・適性のある情報技術および適用分野をいくつか選択し、それらの専門的知識を身につけ、実問題へ応用する方法を学ぶプログラム。', 'なし');

INSERT INTO tbl_wish VALUES
('S0001', 2, 'もっと頑張りたい', '2020-2-19 10:40'),
('S0003', 1, '成績がやばい', '2020-3-11 12:17'),
('S0004', 2, 'なし', '2020-2-23 11:49'),
('S0006', 1, 'なんとなく', '2020-3-20 11:34'),
('S0012', 2, '特になし', '2020-2-17 9:47'),
('S0013', 2, '頑張ります', '2020-2-26 10:50'),
('S0014', 2, '応用プログラムでも良い', '2020-3-7 14:40'),
('S0015', 2, '気持ち', '2020-3-9 17:30'),
('S0017', 1, '人工知能やIoTに興味がある', '2020-3-9 17:30'),
('S0019', 2, '大丈夫かな', '2020-3-11 12:45');

-- 管理者/教員アカウントを追加
 INSERT INTO tbl_user VALUES 
 ('staff', '教員'  ,'3456', 2),
 ('admin', '管理者','5678', 9);

-- 学生アカウントを追加 
 INSERT INTO tbl_user
 SELECT LOWER(sid) AS uid, sname AS uname, '1234' AS upass,1 AS urole 
 FROM tbl_student;
