<?php

$DaySpanishNames = array(
	'Sunday' => 'Domingo',
	'Saturday' => 'Sábado',
	'Monday' => 'Lunes',
	'Tuesday' => 'Martes',
	'Wednesday' => 'Miércoles',
	'Thursday' => 'Jueves',
	'Friday' => 'Viernes'
);

function DateToString($date)
{
    return date('Y-m-d', strtotime($date));
}

function DateToday()
{
    return date('Y-m-d');
}

function DateToISOYearNumber($date)
{
    return date('o', strtotime($date));
}

function DateToISOWeekNumber($date)
{
    return date('W', strtotime($date));
}

function DateToWeekDayName($date)
{
    return date('l', strtotime($date));
}

function DateToWeekDaySpanishName($date)
{
	global $DaySpanishNames;
    return $DaySpanishNames[DateToWeekDayName($date)];
}

function DateToMonday($date)
{
    $dayname = DateToWeekDayName($date);
    
    if ($dayname == 'Monday')
        return $date;
            
    return date('Y-m-d', strtotime('last Monday', strtotime($date)));
}

function DateAddDays($date, $days)
{
    return date('Y-m-d', strtotime($days . ' days', strtotime($date)));
}

function DateAddMonths($date, $months)
{
    return date('Y-m-d', strtotime($months . ' months', strtotime($date)));
}
?>