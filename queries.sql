--all queries with not unique id
SELECT * FROM test WHERE id IN (SELECT id FROM test GROUP BY id HAVING COUNT(*) > 1);
--only non unique id
SELECT DISTINCT id FROM test WHERE (id IN (SELECT id FROM test AS t GROUP BY id HAVING (COUNT(*) > 1))) ORDER BY id;