USE `multi-documents`;

# Cadastrar Documento

# INSERT INTO documento (nome, pais, descricao) VALUES ('a', 'a', 'a');

# Cadastrar Informação

# INSERT INTO parametro (titulo, tipo, regex) VALUES ('a', 'a', NULL);

# Cadastrar Informação (Documento)

# INSERT INTO dados_documento (label, title, placeholder, parametro_id, documento_id) VALUES ('a', 'a', 'a', 1, 1);

# Cadastrar Usuário

# INSERT INTO usuario (nome, local, user, senha, location, token) VALUES ('a', 'a', 'a', sha2("a", 256), POINT(1, 1), md5("a"));

# Cadastrar Documento (Usuário) => {atributo: valor}

# INSERT INTO documentos_usuario (valor, dado_documento_id, usuario_id) VALUES ('a', 1, 1);



# Atualizar Documento

# UPDATE documento d SET d.nome = 'a', d.pais = 'a', d.descricao = 'a' WHERE d.id = 1;

# Atualizar Informação

# UPDATE parametro p SET p.titulo = 'a', p.tipo = 'a', p.regex = 'a' WHERE p.id = 1;

# Atualizar Informação (Documento)

# UPDATE dados_documento d SET d.label = 'a', d.title = 'a', d.placeholder = 'a', d.parametro_id = 1, d.documento_id = 1 WHERE d.id = 1;

# Atualizar Usuário

# UPDATE usuario u SET u.nome = 'a', u.local = 'a', u.user = 'a', u.senha = sha2("a", 256), u.location = POINT(1, 1), u.token = md5("5566") WHERE u.id = 1;

# Atualizar Documento (Usuário) => {atributo: valor}

# UPDATE documentos_usuario d SET d.valor = 'a', d.dado_documento_id = 1, d.usuario_id = 1 WHERE d.id = 1;



# Excluir Documento

# DELETE FROM documento WHERE id = 1;

# Excluir Informação

# DELETE FROM parametro WHERE id = 1;

# Excluir Informação (Documento)

# DELETE FROM dados_documento WHERE id = 1;

# Excluir Usuário

# DELETE FROM usuario WHERE id = 1;

# Excluir Documento (Usuário) => {atributo: valor}

# DELETE FROM documentos_usuario WHERE id = 1;



# Listar Documentos

# SELECT d.id, d.nome, d.pais, d.descricao FROM documento d ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Informações

# SELECT p.id, p.titulo, p.tipo, p.regex FROM parametro p ORDER BY p.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Informações (Documento)

# SELECT d.id, d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Usuários

# SELECT u.id, u.nome, u.local, u.user, u.senha, u.location, u.token FROM usuario u ORDER BY u.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Documento (Usuário) => {atributo: valor}

# SELECT d.id, d.valor, d.dado_documento_id, d.usuario_id FROM documentos_usuario d ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}



# Buscar Documento

# SELECT DISTINCT(d.id), d.nome, d.pais, d.descricao FROM documento d WHERE d.nome LIKE '%a%' OR d.pais LIKE '%a%' OR d.descricao LIKE '%a%' ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Informação

# SELECT DISTINCT(p.id), p.titulo, p.tipo, p.regex FROM parametro p WHERE p.titulo LIKE '%a%' OR p.tipo LIKE '%a%' ORDER BY p.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Informação (Documento)

# SELECT DISTINCT(d.id), d.label, d.title, d.placeholder, d.parametro_id, d.documento_id FROM dados_documento d WHERE d.label LIKE '%a%' OR d.title LIKE '%a%' OR d.placeholder LIKE '%a%' ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Usuário

# SELECT DISTINCT(u.id), u.nome, u.local, u.user, u.senha, u.location, u.token FROM usuario u WHERE u.nome LIKE '%a%' OR u.local LIKE '%a%' OR u.user LIKE '%a%' ORDER BY u.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Documento (Usuário) => {atributo: valor}

# SELECT DISTINCT(d.id), d.valor, d.dado_documento_id, d.usuario_id FROM documentos_usuario d WHERE d.valor LIKE '%a%' ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}



# Listar Informação (Documento) [por parâmetro]

# SELECT d.id, d.label, d.title, d.placeholder, p.titulo FROM dados_documento d, parametro p WHERE d.parametro_id = p.id AND p.id = 6 ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Informação (Documento) [por documento]

# SELECT d.id, d.label, d.title, d.placeholder, doc.nome FROM dados_documento d, documento doc WHERE d.documento_id = doc.id AND doc.id = 1 ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Documento (Usuário) => {atributo: valor} [por informação do documento]

# SELECT d.id, dd.label, d.valor FROM documentos_usuario d, dados_documento dd WHERE d.dado_documento_id = dd.id AND dd.id = 4 ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar Documento (Usuário) => {atributo: valor} [por usuário]

# SELECT d.id, d.valor, u.user FROM documentos_usuario d, usuario u WHERE d.usuario_id = u.id AND u.id = 1 ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}



# Listar Informação (Documento) [por documento] [JSON]

SELECT JSON_OBJECT('nome', doc.nome, 'pais', doc.pais, 'descricao', doc.descricao, 'dados', (SELECT JSON_ARRAYAGG(JSON_OBJECT('parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder))) FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = 1)) AS `json` FROM documento doc WHERE doc.id = 1;

# Listar Atributos (Documento) [por documento] [JSON]

SELECT JSON_OBJECT('parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder)) AS `json` FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = 1;

# Listar Atributos (Documento) [por documento] [JSON Array]

SELECT JSON_ARRAYAGG(JSON_OBJECT('parametro', p.titulo, 'tipo', p.tipo, 'regex', p.regex, 'info', JSON_OBJECT('label', dd.label, 'title', dd.title, 'placeholder', dd.placeholder))) AS `json` FROM documento doc, dados_documento dd, parametro p WHERE dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = 1;






# Listar todos os documentos do usuário [apenas ID]

# SELECT DISTINCT(doc.id), doc.nome FROM usuario u, documentos_usuario du, dados_documento dd, documento doc WHERE du.usuario_id = u.id AND du.dado_documento_id = dd.id AND dd.documento_id = doc.id AND u.id = 1 ORDER BY doc.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar todas as informações do usuário (por documento)

# SELECT p.titulo, du.valor FROM usuario u, documentos_usuario du, dados_documento dd, documento doc, parametro p WHERE du.usuario_id = u.id AND du.dado_documento_id = dd.id AND dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = 1 ORDER BY p.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar todas as informações do usuário [JSON] (sem documentos)

SELECT JSON_OBJECT('id', u.id, 'nome', u.nome, 'user', u.user, 'local', JSON_OBJECT('nome', u.local, 'localizacao', JSON_OBJECT('latitude', ST_X(u.location), 'longitude', ST_Y(u.location)))) AS json FROM usuario u WHERE u.id = 1;




# Listar todas as informações do usuário (por documento) [JSON Array]

SELECT JSON_ARRAYAGG(JSON_OBJECT(p.titulo, du.valor)) AS `json` FROM usuario u, documentos_usuario du, dados_documento dd, documento doc, parametro p WHERE du.usuario_id = u.id AND du.dado_documento_id = dd.id AND dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = 1 ORDER BY p.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Listar todas as informações do usuário (por documento) [JSON]

SELECT REPLACE(REPLACE(REPLACE(REPLACE(JSON_ARRAYAGG(JSON_OBJECT(p.titulo, du.valor)), "{", ""), "}", ""), "[", "{"), "]", "}") AS `json` FROM usuario u, documentos_usuario du, dados_documento dd, documento doc, parametro p WHERE du.usuario_id = u.id AND du.dado_documento_id = dd.id AND dd.documento_id = doc.id AND dd.parametro_id = p.id AND doc.id = 1 ORDER BY p.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}







# Buscar Informação (Documento) [por parâmetro]

# SELECT DISTINCT(d.id), d.label, d.title, d.placeholder, p.titulo FROM dados_documento d, parametro p WHERE (d.parametro_id = p.id AND p.id = 6) AND (d.label LIKE '%a%' OR d.title LIKE '%a%' OR d.placeholder LIKE '%a%') ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Informação (Documento) [por documento]

# SELECT DISTINCT(d.id), d.label, d.title, d.placeholder, doc.nome FROM dados_documento d, documento doc WHERE (d.documento_id = doc.id AND doc.id = 1) AND (d.label LIKE '%a%' OR d.title LIKE '%a%' OR d.placeholder LIKE '%a%') ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Documento (Usuário) => {atributo: valor} [por informação do documento]

# SELECT DISTINCT(d.id), dd.label, d.valor FROM documentos_usuario d, dados_documento dd WHERE (d.dado_documento_id = dd.id AND dd.id = 4) AND (d.valor LIKE '%a%') ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}

# Buscar Documento (Usuário) => {atributo: valor} [por usuário]

# SELECT DISTINCT(d.id), d.valor, u.user FROM documentos_usuario d, usuario u WHERE (d.usuario_id = u.id AND u.id = 1) AND (d.valor LIKE '%a%') ORDER BY d.id ASC LIMIT 0, 20; # LIMIT {offset}, {limit}



# Login do usuário

SELECT IF((SELECT u.id FROM usuario u WHERE u.user = "luciano22" AND u.senha = sha2("123", 256)) IS NOT NULL, true, false) AS login;

SELECT * FROM usuario;

# Verificar se usuário já existe

SELECT IF((SELECT u.id FROM usuario u WHERE u.user = "mateus22") IS NOT NULL, true, false) AS `exists`;

# Verificar se documento já existe

SELECT IF((SELECT d.id FROM documento d WHERE d.nome = "RG" AND d.pais = "Brasil") IS NOT NULL, true, false) AS `exists`;

# Verificar se parâmetro já existe

SELECT IF((SELECT p.id FROM parametro p WHERE p.titulo = "numero_rg" AND p.tipo = "texto") IS NOT NULL, true, false) AS `exists`;

# Verificar se dado já existe (apenas pelo nome)

SELECT IF((SELECT dd.id FROM dados_documento dd WHERE dd.label = "nome") IS NOT NULL, true, false) AS `exists`;

# Verificar se dado já existe (apenas pelo parâmetro e documento)

SELECT IF((SELECT dd.id FROM dados_documento dd WHERE dd.parametro_id = 1 AND dd.documento_id = 1) IS NOT NULL, true, false) AS `exists`;

# Verificar se dado já existe (nome, parâmetro e documento)

SELECT IF((SELECT dd.id FROM dados_documento dd WHERE dd.label = "nome" AND dd.parametro_id = 1 AND dd.documento_id = 1) IS NOT NULL, true, false) AS `exists`;

# Verificar se informação do documento já existe (pelo parâmetro e documento)

SELECT IF((SELECT du.id FROM documentos_usuario du WHERE du.dado_documento_id = 1 AND du.usuario_id = 1) IS NOT NULL, true, false) AS `exists`;

# APAGAR UM DOCUMENTO POR COMPLETO (próxima versão: apagar todos os parâmetros que sejam específicos apenas deste documento)

# SELECT d.id FROM dados_documento d WHERE d.documento_id = 1;

# DELETE FROM documentos_usuario WHERE dado_documento_id = 1;

# DELETE FROM dados_documento WHERE documento_id = 1;

# Atualizar TOKEN do usuário

UPDATE usuario u SET u.token = md5("5566") WHERE u.id = 1;
