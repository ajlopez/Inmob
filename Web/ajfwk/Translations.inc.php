<?
include_once('Database.inc.php');

function TranslateDescription($table,$id,$description='DESCRIPTION',$idfld='ID')
{
	if (!$id)
		return '';

	DbConnect();

 	$rsData = DbExecuteQuery("Select $description from $table where $idfld = '$id'");
	$reg = DbNextRow($rsData);

	if ($reg)
		$IdDescription = $reg[$description];
	else
		$IdDescription = "$table $id";

	DbDisconnect();

	return $IdDescription;
}

function TranslateQuery($table,$description='Description', $where='')
{
	DbConnect();
    $sql = "select Id, $description from $table";
    if ($where)
        $sql .= " where $where";
    $sql .= " order by 2";
	$rs = DbExecuteQuery($sql);
	DbDisconnect();
	return $rs;
}

function TranslateEnumeration(&$values,$value)
{
	if ($values[$value])
		return $values[$value];

	return $value;
}

function TranslateBoolean($value, $yes='Yes', $no='No')
{
    if ($value)
        return $yes;
    return $no;
}

?>