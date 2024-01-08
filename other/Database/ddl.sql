-- bfi_sql_20231023
-- 2023 10 25
-- Datenbanken

SELECT * FROM `Skill` WHERE FKHauptSkill IS NULL;

SELECT * FROM `Skill` WHERE FKHauptSkill IS NOT NULL;

-- Joins
SELECT * FROM `Skill` ober, `Skill` unter
WHERE ober.SkillID = unter.FKHauptSkill AND ober.Bezeichnung = 'Datenbanken';

SELECT * FROM `Skill` ober INNER JOIN `Skill` unter ON ober.SkillID = unter.FKHauptSkill
WHERE ober.Bezeichnung = 'Datenbanken';