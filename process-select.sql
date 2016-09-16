/** ------ SELECT query for process TAB per positions ------ **/


/** HRMO **/
SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isHRMO,p.hrmodatereceived,p.hrmodatereleased,c.ok from tblappointee as a
LEFT JOIN tblprocess as p
on a.itemno = p.itemno
LEFT JOIN tblcongratulatory as c
on p.itemno = c.itemno
where c.ok = 'YES' AND p.hrmodatereceived is not null;

/** BO **/
SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isBO,p.bodatereceived,p.bodatereleased,c.ok from tblappointee as a
LEFT JOIN tblprocess as p
on a.itemno = p.itemno
LEFT JOIN tblcongratulatory as c
on p.itemno = c.itemno
where c.ok = 'YES' AND p.bodatereceived is not null;

/** SGOD **/
SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isSGOD,p.sgoddatereceived,p.sgoddatereleased,c.ok from tblappointee as a
LEFT JOIN tblprocess as p
on a.itemno = p.itemno
LEFT JOIN tblcongratulatory as c
on p.itemno = c.itemno
where c.ok = 'YES' AND p.sgoddatereceived is not null;

/** ASDS **/
SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isASDS,p.asdsdatereceived,p.asdsdatereleased,c.ok from tblappointee as a
LEFT JOIN tblprocess as p
on a.itemno = p.itemno
LEFT JOIN tblcongratulatory as c
on p.itemno = c.itemno
where c.ok = 'YES' AND p.asdsdatereceived is not null;

/** SDS **/
SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isSDS,p.sdsdatereceived,p.sdsdatereleased,c.ok from tblappointee as a
LEFT JOIN tblprocess as p
on a.itemno = p.itemno
LEFT JOIN tblcongratulatory as c
on p.itemno = c.itemno
where c.ok = 'YES' AND p.sgoddatereceived is not null;