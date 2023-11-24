<?php


$party_map = array(
    '國會政黨聯盟' => 19,
    '時代力量' => 11,
    '宗教聯盟' => 20,
    '台灣基進' => 21,
    '民主進步黨' => 1,
    '勞動黨' => 22,
    '中國國民黨' => 9,
    '綠黨' => 23,
    '親民黨' => 2,
    '台灣民眾黨' => 24,
    '台灣團結聯盟' => 10,
    '台灣維新' => 25,
    '台澎黨' => 26,
    '中華統一促進黨' => 8,
    '喜樂島聯盟' => 27,
    '新黨' => 16,
    '合一行動聯盟' => 28,
    '一邊一國行動黨' => 29,
    '安定力量' => 30,
    '臺灣雙語無法黨' => 31,
    '小民參政歐巴桑聯盟' => 32,
    '台灣綠黨' => 33,
    '司法改革黨' => 34,
    '人民最大黨' => 35,
    '制度救世島' => 36,
);
// https://docs.google.com/spreadsheets/d/1zR2QeHyKyv34sKd2I6g-_N6o6x7-cBpbd-9ogmit898/edit#gid=1577964247
$fp = fopen('https://docs.google.com/spreadsheets/d/e/2PACX-1vROtl096aU7ce1rpryefCmYB5rP7ZCRxk4uHsmhRM2gBdC4QNJliMcvWFo_GJqY3pDQFbcK03w2yuzK/pub?gid=1577964247&single=true&output=csv', 'r');
$ret = array();
$columns = fgetcsv($fp);
while ($rows = fgetcsv($fp)) {
    list(, $party, $seq, $name, $gender,) = $rows;
    if (!array_key_exists($party, $party_map)) {
        throw new Exception("{$party} not found");
    }
    $ret[] = array(
        'drawno' => $party_map[$party],
        'candidatename' => $name,
        'nosequence' => intval($seq),
        'gender' => ($gender == '男') ? 'M': 'F',
    );
}
file_put_contents('candidates.json', json_encode(array('全國不分區及僑居國外國民立委公報' => $ret), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
