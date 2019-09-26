-- Função que retorna o total de carimbos por loja e por dia
CREATE FUNCTION carimbos_por_loja_e_dia(loja INT, dia DATE) RETURNS INT
BEGIN

    -- Select de busca
    RETURN
        (SELECT
            COUNT(*) as Total
        FROM registro_cartaoFidelidade rcf
        LEFT JOIN cartaoFidelidade cf on rcf.fk_carimbo = cf.id
        INNER JOIN lojas l on cf.fk_loja = l.id
        WHERE DATE(data_registro) = dia AND l.id = loja);

END;

-- Dropando a função
DROP FUNCTION carimbos_por_loja_e_dia;

-- Usando a função
SELECT carimbos_por_loja_e_dia(1, DATE_SUB(NOW(), INTERVAL 0 DAY));

-- Criando procedimento que busca os carimbos por uma loja nos ultimos 7 dias
CREATE PROCEDURE carimbos_7_dias(loja INT)
BEGIN

    -- Variaveis dos dias
    DECLARE dia_1 DATE;
    DECLARE dia_2 DATE;
    DECLARE dia_3 DATE;
    DECLARE dia_4 DATE;
    DECLARE dia_5 DATE;
    DECLARE dia_6 DATE;
    DECLARE dia_7 DATE;

    -- Variaveis dos counts
    DECLARE count_dia_1 INT;
    DECLARE count_dia_2 INT;
    DECLARE count_dia_3 INT;
    DECLARE count_dia_4 INT;
    DECLARE count_dia_5 INT;
    DECLARE count_dia_6 INT;
    DECLARE count_dia_7 INT;

    -- Atribuicao de dias
    SET dia_1 = DATE_SUB(NOW(), INTERVAL 0 DAY);
    SET dia_2 = DATE_SUB(NOW(), INTERVAL 1 DAY);
    SET dia_3 = DATE_SUB(NOW(), INTERVAL 2 DAY);
    SET dia_4 = DATE_SUB(NOW(), INTERVAL 3 DAY);
    SET dia_5 = DATE_SUB(NOW(), INTERVAL 4 DAY);
    SET dia_6 = DATE_SUB(NOW(), INTERVAL 5 DAY);
    SET dia_7 = DATE_SUB(NOW(), INTERVAL 6 DAY);

    -- Atribuicao dos counts usando a funcao criada
    SET count_dia_1 = (SELECT carimbos_por_loja_e_dia(loja, dia_1));
    SET count_dia_2 = (SELECT carimbos_por_loja_e_dia(loja, dia_2));
    SET count_dia_3 = (SELECT carimbos_por_loja_e_dia(loja, dia_3));
    SET count_dia_4 = (SELECT carimbos_por_loja_e_dia(loja, dia_4));
    SET count_dia_5 = (SELECT carimbos_por_loja_e_dia(loja, dia_5));
    SET count_dia_6 = (SELECT carimbos_por_loja_e_dia(loja, dia_6));
    SET count_dia_7 = (SELECT carimbos_por_loja_e_dia(loja, dia_7));

    -- Exibicao do resultado com select
    SELECT count_dia_1 as count, dia_1 as dia
    UNION ALL
    SELECT count_dia_2 as count, dia_2 as dia
    UNION ALL
    SELECT count_dia_3 as count, dia_3 as dia
    UNION ALL
    SELECT count_dia_4 as count, dia_4 as dia
    UNION ALL
    SELECT count_dia_5 as count, dia_5 as dia
    UNION ALL
    SELECT count_dia_6 as count, dia_6 as dia
    UNION ALL
    SELECT count_dia_7 as count, dia_7 as dia;

END;

-- Deltando um procedimento
DROP PROCEDURE carimbos_7_dias;

-- Usando um procedimento
CALL carimbos_7_dias(1);
