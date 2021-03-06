-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-07-01 16:14:47
-- 服务器版本： 5.7.26
-- PHP 版本： 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `wxmini`
--

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `open_times_limit` int(1) NOT NULL DEFAULT '0',
  `username` text,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `open_times_limit`, `username`, `password`) VALUES
(1, 0, 'star', '8ff953dd97c4405234a04291dee39e0b');

-- --------------------------------------------------------

--
-- 表的结构 `element`
--

DROP TABLE IF EXISTS `element`;
CREATE TABLE IF NOT EXISTS `element` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `chn` varchar(17) DEFAULT NULL,
  `eng` varchar(31) DEFAULT NULL,
  `jap` varchar(18) DEFAULT NULL,
  `kor` varchar(29) DEFAULT NULL,
  `alias` varchar(25) DEFAULT NULL,
  `harm` varchar(139) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `element`
--

INSERT INTO `element` (`id`, `chn`, `eng`, `jap`, `kor`, `alias`, `harm`) VALUES
(1, 'DMDM乙内酰脲', 'DMDM HYDANTOIN', 'ＤＭＤＭヒダントイン', '디엠디엠하이단토인', '二羟甲基二甲基乙内酰脲', '传统甲醛释放型防腐剂，通过释放甲醛达到抑菌防腐效果，可能对皮肤造成刺激，并导致过敏。刺激程度：中度'),
(2, '双（羟甲基）咪唑烷基脲', 'DIAZOLIDINYL UREA，Germall II', 'null', '디아졸리디닐우레아', '重氮咪唑烷基脲', '传统甲醛释放型防腐剂，通过释放甲醛达到抑菌防腐效果，可能对皮肤造成刺激，并导致过敏。刺激程度：高度'),
(3, '季铵盐-15', 'QUATERNIUM-15', 'クオタニウム－１５', '쿼터늄-15', 'null', '甲醛释放型防腐剂，通过释放甲醛达到抑菌防腐效果，容易对皮肤造成刺激和过敏。危害程度：高度'),
(4, '咪唑烷基脲', 'IMIDAZOLIDINYL UREA，Germall-115', 'イミダゾリジニルウレア', '이미다졸리디닐우레아', '尿素醛，咪唑啉基尿素，烷基咪唑脲，羟甲基咪唑烷基脲', '传统甲醛释放型防腐剂，通过释放甲醛达到抑菌防腐效果，可能对皮肤造成刺激，并导致过敏。刺激程度：高度'),
(5, '2-溴-2-硝基丙烷-1,3-二醇', '2-BROMO-2-NITROPROPANE-1,3-DIOL', 'null', '2-브로모-2-나이트로프로판-1,3-디올', '溴硝丙二醇，布罗波尔', '传统甲醛释放型防腐剂，可释放微量甲醛，反馈过敏和刺激的人数较多。危害程度：高度'),
(6, '甲基异噻唑啉酮(MI)', 'METHYLISOTHIAZOLINONE', 'メチルイソチアゾリノン', '메칠이소치아졸리논', 'null', '属于严格限用剂量的高致敏防腐剂，与MCI合用称为卡松。易导致皮肤炎，可能有神经毒性，我国要求添加剂量不得超过0.01%。尽量不要选择使用含有此类防腐剂的驻留型产品'),
(7, '甲基氯异噻唑啉酮(MCI)', 'METHYLCHLOROISOTHIAZOLINONE', 'メチルクロロイソチアゾリノン', '메칠클로로이소치아졸리논', 'null', '属于严格限用剂量的高致敏防腐剂，与MI合用称为卡松。易导致皮肤炎，可能有神经毒性，我国要求添加剂量不得超过0.01%。尽量不要选择使用含有此类防腐剂的驻留型产品'),
(8, '羟苯丙酯', 'PROPYLPARABEN', 'プロピルパラベン', '프로필파라벤', '尼泊金丙酯，对羟基苯甲酸丙酯', '长链尼泊金酯类，油溶性强，属于高效抑菌剂，容易导致皮肤过敏，少部分人群可能得接触性皮炎'),
(9, '羟苯丙酯钠', 'SODIUM PROPYLPARABEN', 'プロピルパラベンＮａ', '소듐프로필파라벤', 'null', '长链尼泊金丙酯的钠盐，增加了水溶性，属于中高效抑菌剂。容易导致皮肤过敏，少部分人群可能得接触性皮炎'),
(10, '羟苯丙酯钾', 'POTASSIUM PROPYLPARABEN', 'null', 'null', 'null', '长链尼泊金丙酯的钾盐，增加了水溶性，属于中高效抑菌剂。容易导致皮肤过敏，少部分人群可能得接触性皮炎'),
(11, '羟苯丁酯', 'BUTYLPARABEN', 'ブチルパラベン', '부틸파라벤', '尼泊金丁酯，对羟基苯甲酸丁酯', '长链尼泊金酯类，比羟苯丙酯的杀菌能力更强，属高效抑菌剂，但容易导致皮肤过敏，部分人群可能得接触性皮炎'),
(12, '羟苯丁酯钠', 'SODIUM BUTYLPARABEN', 'ブチルパラベンＮａ', '소듐부틸파라벤', 'null', '长链尼泊金丁酯的钠盐，比羟苯丙酯的杀菌能力更强，属高效抑菌剂，但容易导致皮肤过敏，部分人群可能得接触性皮炎'),
(13, '羟苯丁酯钾', 'POTASSIUM BUTYLPARABEN', 'null', 'null', 'null', '长链尼泊金丁酯的钾盐，杀菌能力更强，属高效抑菌剂，但容易导致皮肤过敏，部分人群可能得接触性皮炎'),
(14, '羟苯异丁酯', 'ISOBUTYLPARABEN', 'イソブチルパラベン', '이소부틸파라벤', 'null', '长链尼泊金酯类，杀菌能力强，属高效抑菌剂，但容易导致皮肤过敏，部分人群可能得接触性皮炎'),
(15, '羟苯异丁酯钠', 'SODIUM ISOBUTYLPARABEN', 'イソブチルパラベンＮａ', '소듐이소부틸파라벤', 'null', '长链尼泊金异丁酯的钠盐，水溶性好，杀菌能力强，属高效抑菌剂，但容易导致皮肤过敏，部分人群可能得接触性皮炎'),
(16, '硼酸', 'BORIC ACID', 'null', '보릭애씨드', '原硼酸', '传统抑菌防腐剂，多用于水溶液中，容易被损伤的皮肤吸收并导致中毒。'),
(17, '碘丙炔醇丁基氨甲酸酯', 'IODOPROPYNYL BUTYLCARBAMATE', 'ブチルカルバミン酸ヨウ化プロピニル', '아이오도프로피닐부틸카바메이트', 'null', 'IPBC属于传统防腐剂，抗真菌效果较好，在很多国家被禁用或严格限用，身体乳或三岁以下儿童产品中禁止使用。'),
(18, '乙醇', 'ALCOHOL', 'エタノール', '에탄올,무수에탄올', '酒精', '常见护肤品主要溶剂之一，肤感好，能造成容易吸收的假象。但去脂力非常强，而且刺激性较强，长期使用会导致角质变薄，皮肤变干失去光泽以及更敏感。因此当乙醇在成分表中排名前5位的时候，干性皮肤，敏感肌或婴幼儿等需要谨慎使用或避免使用。'),
(19, '变性乙醇', 'ALCOHOL DENAT', '変性アルコール', '변성알코올', 'null', '与乙醇相同，目前加入护肤品中的变性乙醇均为工业酒精。常见护肤品主要溶剂之一，肤感好，能造成容易吸收的假象。但去脂力非常强，而且刺激性较强，长期使用会导致角质变薄，皮肤变干失去光泽以及更敏感。因此当乙醇在成分表中排名前5位的时候，干性皮肤，敏感肌或婴幼儿等需要谨慎使用或避免使用。'),
(20, '月桂酸钠', 'SODIUM LAURATE', 'ラウリン酸Ｎａ', '소듐라우레이트', 'null', '最常见的皂基成分之一，强碱性，清洁力强，但去脂力和刺激性过强。长期使用会破坏皮肤表层油脂和菌群平衡，导致皮肤敏感。'),
(21, '硬脂酸钾', ' POTASSIUM STEARATE', 'ステアリン酸Ｋ', '포타슘스테아레이트', 'null', '最常见的皂基成分之一，强碱性，清洁力强，但去脂力和刺激性过强。长期使用会破坏皮肤表层油脂和菌群平衡，导致皮肤敏感。'),
(22, '硬脂酸', 'STEARIC ACID', 'ステアリン酸', '스테아릭애씨드', '十八酸，十八烷酸', '常见长链饱和脂肪酸，可以做柔润剂使用，但不建议油皮或者混有皮肤使用，可能会引发或加重痤粉刺和痤疮问题。在洗护产品中可与碱生成皂基，因此需要注意成分表中是否有碱存在。'),
(23, '肉豆蔻酸', 'MYRISTIC ACID', 'ミリスチン酸', '미리스틱애씨드', '十四烷脂肪酸', '常见长链饱和脂肪酸，可以做柔润剂使用，但不建议油皮或者混有皮肤使用，可能会引发或加重痤粉刺和痤疮问题。在洗护产品中可与碱生成皂基，因此需要注意成分表中是否有碱存在。'),
(24, '月桂酸', 'LAURIC ACID', 'ラウリン酸', '라우릭애씨드', 'null', '常见长链饱和脂肪酸，可以做柔润剂使用，但不建议油皮或者混有皮肤使用，可能会引发或加重痤粉刺和痤疮问题。在洗护产品中可与碱生成皂基，因此需要注意成分表中是否有碱存在。'),
(25, '氢氧化钾', 'POTASSIUM HYDROXIDE', '水酸化Ｋ', '포타슘하이드록사이드', 'null', '强碱，但添加量较低，仅作为调节酸碱度（pH）使用，大多数情况下不需要担心。如果出现在洁面或者洗护产品中，需要注意是否有饱和脂肪酸如硬脂酸，月桂酸或者肉豆蔻酸等一起存在，即可判定产品为皂基产品，干皮或者敏感肌肤需要慎重或者避免使用。'),
(26, '氢氧化钠', 'SODIUM HYDROXIDE', '水酸化Ｎａ', '소듐하이드록사이드', 'null', '强碱，但添加量较低，仅作为调节酸碱度（pH）使用，大多数情况下不需要担心。如果出现在洁面或者洗护产品中，需要注意是否有饱和脂肪酸如硬脂酸，月桂酸或者肉豆蔻酸等一起存在，即可判定产品为皂基产品，干皮或者敏感肌肤需要慎重或者避免使用。'),
(27, '月桂醇硫酸酯钠（SLS）', 'SODIUM LAURYL SULFATE', 'ラウリル硫酸Ｎａ', '소듐라우릴설페이트,소듐라우릴설페이트액', '十二烷基硫酸钠', '最典型的硫酸盐表面活性剂，对皮肤的刺激性过强，且容易导致假滑。长期使用，会破坏表层油脂和皮肤菌群。另外副产物中很可能含有二恶烷等致癌物，虽然因为成本低，使用在大量的开架产品中，但我们不建议使用这种逐渐被淘汰的成分。'),
(28, '月桂醇聚醚硫酸酯钠（SLES）', 'SODIUM LAURETH SULFATE', 'ラウレス硫酸Ｎａ', '소듐라우레스설페이트,소듐폴리옥시에칠렌라우릴에텔설페이트', 'null', '与SLS一样，属于典型的硫酸盐表面活性剂，但相对温和一点。对皮肤的刺激性过强，且容易导致假滑。长期使用，会破坏表层油脂和皮肤菌群。另外副产物中很可能含有二恶烷等致癌物，虽然因为成本低，使用在大量的开架产品中，但我们不建议使用这种逐渐被淘汰的成分。'),
(29, '环五聚二甲基硅氧烷（D5）', 'CYCLOPENTASILOXANE', 'シクロペンタシロキサン', '사이클로펜타실록산,데카메칠사이클로펜타실록산', '环戊甲基硅氧烷，环戊硅氧烷', 'D5是目前最常见的溶剂之一，肤感好，能造成假吸收的错觉，而且成本较低。但目前认为D5对环境有不可忽视的污染和威胁，而且含有的杂质D4存在生殖毒性。因此目前包括欧盟在内的多个国家，已经开始禁止使用含有D5的洗护产品。'),
(30, '奥克立林', 'OCTOCRYLENE', 'オクトクリレン', '옥토크릴렌', 'null', '油性化学防晒剂，防护波段较为有限。而且不稳定，见光后容易释放出氧自由基，可能会加速皮肤衰老，目前最大安全限量为10%，美国FDA禁止使用此类成分的化学防晒产品。'),
(31, '二苯酮-3', 'BENZOPHENONE-3', 'オキシベンゾン－３', '벤조페논-3', 'null', 'BP3是老牌化学防晒成分，但危险指数非常高。容易被皮肤吸收且在体内富集，有明显的光毒性。而且添加量低，防晒效果不好。美国FDA禁止使用此类成分的化学防晒产品。'),
(32, '胡莫柳酯', 'HOMOSALATE', 'ホモサレート', '호모살레이트', 'null', '化学防晒剂，FDA临床试验表明容易被皮肤吸收。'),
(33, '甲氧基肉桂酸乙基己酯', ' ETHYLHEXYL METHOXYCINNAMATE', 'null', '에칠헥실메톡시신나메이트,옥틸메톡시신나메이트', 'null', '桂皮酸盐是目前使用最多的化学防晒剂，但防护波段有限，而且有类雌激素的所用，可能会干扰激素水平。'),
(34, '水杨酸苄酯', 'BENZYL SALICYLATE', 'サリチル酸ベンジル', '벤질살리실레이트', 'null', '属于化学防晒剂和调香成分，不适合孕妇以及对水杨酸类成分过敏的人群使用'),
(35, '4-甲基苄亚基樟脑', '4-METHYLBENZYLIDENE CAMPHOR', 'メチルベンジリデンカンファ', '4-메칠벤질리덴캠퍼', 'null', '欧盟认为4-MBC可能会影响甲状腺激素水平，要求限量使用；美国FDA已经禁止使用防晒产品中添加此成分。'),
(36, '丁基甲氧基二苯甲酰基甲烷', 'BUTYL METHOXYDIBENZOYLMETHANE', 'ｔ－ブチルメトキシジベンゾイルメタン', '부틸메톡시디벤조일메탄', 'null', '又名阿伏苯宗，属于最常使用的UVA防晒剂，但光稳定性很差，容易见光分解，而且容易导致皮肤过敏。如果和桂皮酸盐等防晒成分一起使用，防晒效果会大打折扣。'),
(37, '三氯生', 'TRICLOSAN', 'トリクロサン', '트리클로산', '三氯沙', '老牌强效抑菌剂。不少临床试验表明，三氯生与过敏性皮炎和接触皮肤炎有直接关系。即使是低剂量使用，也可能会导致过敏和免疫系统紊乱。目前在很多国家已经禁止使用。'),
(38, '三氯卡班', 'TRICLOCARBAN', 'トリクロカルバン', '트리클로카반', 'null', '老牌强效抑菌剂。不少临床试验表明，三氯生与过敏性皮炎和接触皮肤炎有直接关系。即使是低剂量使用，也可能会导致过敏和免疫系统紊乱，此外甲状腺和生育系统等也会引起改变。目前在很多国家已经禁止使用。'),
(39, '氯己定', 'CHLORHEXIDINE', 'クロルヘキシジン', 'null', '葡糖酸氯己定，洗必泰', '常见的抑菌成分。'),
(40, '西吡氯铵（CPC）', 'CETYLPYRIDINIUM CHLORIDE', 'セチルピリジニウムクロリド', '세틸피리디늄클로라이드', '氯化十六烷基呲啶', '常见的抑菌成分。'),
(41, '度米芬', 'DOMIPHEN BROMIDE', '臭化ドミフェン', '도미펜브로마이드', '消毒宁、弗洛丙酮', '常见的抑菌成分。');

-- --------------------------------------------------------

--
-- 表的结构 `element_tset`
--

DROP TABLE IF EXISTS `element_tset`;
CREATE TABLE IF NOT EXISTS `element_tset` (
  `id` int(2) NOT NULL,
  `chn` varchar(4) DEFAULT NULL,
  `eng` varchar(30) DEFAULT NULL,
  `jap` varchar(7) DEFAULT NULL,
  `kor` varchar(8) DEFAULT NULL,
  `alias` varchar(7) DEFAULT NULL,
  `harm` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `element_tset`
--

INSERT INTO `element_tset` (`id`, `chn`, `eng`, `jap`, `kor`, `alias`, `harm`) VALUES
(1, '成分一', 'Composition of a', 'せいぶん 1', '성분 1', '成分一的别名', '成分一的危害'),
(2, '成分二', 'Component 2', 'せいぶん 2', '성분 2', '成分二的别名', '成分二的危害'),
(3, '成分三', 'Composition of the three', 'せいぶん 3', '성분 3', '成分三的别名', '成分三的危害'),
(4, '成分四', 'Composition of the four', 'せいぶん 4', '성분 4', '成分四的别名', '成分四的危害'),
(5, '成分五', 'Composition of five', 'せいぶん 5', '성분 5', '成分五的别名', '成分五的危害'),
(6, '成分六', 'Element six', 'せいぶん 6', '성분 6', '成分六的别名', '成分六的危害'),
(7, '成分七', 'Composition of seven', 'せいぶん 7', '성분 7', '成分七的别名', '成分七的危害'),
(8, '成分八', 'Composition of eight', 'せいぶん 8', '성분 8', '成分八的别名', '成分八的危害'),
(9, '成分九', 'Composition of nine', 'せいぶん 9', '성분 9', '成分九的别名', '成分九的危害'),
(10, '成分十', 'The composition of ten', 'せいぶん 10', '성분 10', '成分十的别名', '成分十的危害'),
(11, '成分十一', 'Composition of 11', 'せいぶん 11', '성분 11', '成分十一的别名', '成分十一的危害'),
(12, '成分十二', 'Elements twelve', 'せいぶん 12', '성분 12', '成分十二的别名', '成分十二的危害'),
(13, '成分十三', 'Composition of 13', 'せいぶん 13', '성분이 13이다', '成分十三的别名', '成分十三的危害'),
(14, '成分十四', 'Composition of the fourteenth', 'せいぶん 14', '성분 14', '成分十四的别名', '成分十四的危害'),
(15, '成分十五', 'Composition of fifteen', 'せいぶん 15', '성분 15', '成分十五的别名', '成分十五的危害'),
(16, '成分十六', 'Composition of 16', 'せいぶん 16', '성분 16', '成分十六的别名', '成分十六的危害'),
(17, '成分十七', 'Composition of the seventeenth', 'せいぶん 17', '성분 17', '成分十七的别名', '成分十七的危害'),
(18, '成分十八', 'Composition of the eighteenth', 'せいぶん 18', '성분 18', '成分十八的别名', '成分十八的危害'),
(19, '成分十九', 'Ingredients in the 19th', 'せいぶん 19', '성분 19', '成分十九的别名', '成分十九的危害'),
(20, '成分二十', 'Composition of twenty', 'せいぶん 20', '성분이 20이다', '成分二十的别名', '成分二十的危害');

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `token`
--

INSERT INTO `token` (`id`, `token`, `time`) VALUES
(30, '34_ZgQx5j1BaP5mvvXYO0Pf99Rh5JaDtuk7lXhSm1w_ZuWbN4BGDmiMHF33kbe7SGID1IBq5m9tsSyGnYisYZM1DM6Hwt7FQ6dy4-LicyAFwAoiMaTUx7Ag8tC0kk0anMFcPeH-6lEgMTC3ZmcHSUOjAAAMOI', 1593616504);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` text,
  `times` int(8) NOT NULL DEFAULT '0',
  `day` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `openid`, `times`, `day`) VALUES
(7, '666', 1, 1591523411),
(6, NULL, 2, 1591468438);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
