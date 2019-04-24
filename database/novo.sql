--
-- PostgreSQL database dump
--

-- Dumped from database version 10.7
-- Dumped by pg_dump version 10.7

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: agendalocal; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA agendalocal;


ALTER SCHEMA agendalocal OWNER TO postgres;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: anuncios; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.anuncios (
    id_anuncio integer NOT NULL,
    id_cidade integer NOT NULL,
    nome character varying(255) NOT NULL,
    tipo character varying(255) NOT NULL,
    expira_em date NOT NULL
);


ALTER TABLE agendalocal.anuncios OWNER TO postgres;

--
-- Name: anuncios_id_anuncio_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.anuncios_id_anuncio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.anuncios_id_anuncio_seq OWNER TO postgres;

--
-- Name: anuncios_id_anuncio_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.anuncios_id_anuncio_seq OWNED BY agendalocal.anuncios.id_anuncio;


--
-- Name: cidades; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.cidades (
    id_cidade integer NOT NULL,
    id_estado integer NOT NULL,
    nome character varying(255) NOT NULL
);


ALTER TABLE agendalocal.cidades OWNER TO postgres;

--
-- Name: cidades_id_cidade_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.cidades_id_cidade_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.cidades_id_cidade_seq OWNER TO postgres;

--
-- Name: cidades_id_cidade_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.cidades_id_cidade_seq OWNED BY agendalocal.cidades.id_cidade;


--
-- Name: clientes; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.clientes (
    id_cliente integer NOT NULL,
    id_cidade integer NOT NULL,
    id_tiporegistro integer NOT NULL,
    nome character varying(255) NOT NULL,
    telefone character varying(255) NOT NULL,
    endereco character varying(255) NOT NULL,
    numero character varying(255) NOT NULL,
    atividade character varying(255),
    is_cliente integer NOT NULL,
    logomarca character varying(512)
);


ALTER TABLE agendalocal.clientes OWNER TO postgres;

--
-- Name: clientes_id_cliente_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.clientes_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.clientes_id_cliente_seq OWNER TO postgres;

--
-- Name: clientes_id_cliente_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.clientes_id_cliente_seq OWNED BY agendalocal.clientes.id_cliente;


--
-- Name: estados; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.estados (
    id_estado integer NOT NULL,
    nome character varying(255) NOT NULL,
    sigla character varying(2) NOT NULL
);


ALTER TABLE agendalocal.estados OWNER TO postgres;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.estados_id_estado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.estados_id_estado_seq OWNER TO postgres;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.estados_id_estado_seq OWNED BY agendalocal.estados.id_estado;


--
-- Name: inscricoes; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.inscricoes (
    nome text,
    telefone text,
    cep text,
    endereco text,
    cpf text,
    logomarca text,
    plano text,
    email text,
    senha text,
    atividade text,
    spagamento text,
    "dataCadastro" text,
    id integer NOT NULL
);


ALTER TABLE agendalocal.inscricoes OWNER TO postgres;

--
-- Name: inscricoes_id_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.inscricoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.inscricoes_id_seq OWNER TO postgres;

--
-- Name: inscricoes_id_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.inscricoes_id_seq OWNED BY agendalocal.inscricoes.id;


--
-- Name: niveis_acesso; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.niveis_acesso (
    id_nivelacesso integer NOT NULL,
    nome character varying(255) NOT NULL
);


ALTER TABLE agendalocal.niveis_acesso OWNER TO postgres;

--
-- Name: niveis_acesso_id_nivelacesso_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.niveis_acesso_id_nivelacesso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.niveis_acesso_id_nivelacesso_seq OWNER TO postgres;

--
-- Name: niveis_acesso_id_nivelacesso_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.niveis_acesso_id_nivelacesso_seq OWNED BY agendalocal.niveis_acesso.id_nivelacesso;


--
-- Name: planos; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.planos (
    id integer NOT NULL,
    plano1link text,
    plano2link text,
    plano1valor text,
    plano2valor text
);


ALTER TABLE agendalocal.planos OWNER TO postgres;

--
-- Name: tipos_registro; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.tipos_registro (
    id_tiporegistro integer NOT NULL,
    nome character varying(255) NOT NULL
);


ALTER TABLE agendalocal.tipos_registro OWNER TO postgres;

--
-- Name: tipos_registro_id_tiporegistro_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.tipos_registro_id_tiporegistro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.tipos_registro_id_tiporegistro_seq OWNER TO postgres;

--
-- Name: tipos_registro_id_tiporegistro_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.tipos_registro_id_tiporegistro_seq OWNED BY agendalocal.tipos_registro.id_tiporegistro;


--
-- Name: usuarios; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.usuarios (
    id_usuario integer NOT NULL,
    id_nivelacesso integer NOT NULL,
    pnome character varying(255) NOT NULL,
    snome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    login character varying(255) NOT NULL,
    senha character varying(255) NOT NULL
);


ALTER TABLE agendalocal.usuarios OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.usuarios_id_usuario_seq OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.usuarios_id_usuario_seq OWNED BY agendalocal.usuarios.id_usuario;


--
-- Name: anuncios id_anuncio; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.anuncios ALTER COLUMN id_anuncio SET DEFAULT nextval('agendalocal.anuncios_id_anuncio_seq'::regclass);


--
-- Name: cidades id_cidade; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.cidades ALTER COLUMN id_cidade SET DEFAULT nextval('agendalocal.cidades_id_cidade_seq'::regclass);


--
-- Name: clientes id_cliente; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes ALTER COLUMN id_cliente SET DEFAULT nextval('agendalocal.clientes_id_cliente_seq'::regclass);


--
-- Name: estados id_estado; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.estados ALTER COLUMN id_estado SET DEFAULT nextval('agendalocal.estados_id_estado_seq'::regclass);


--
-- Name: inscricoes id; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.inscricoes ALTER COLUMN id SET DEFAULT nextval('agendalocal.inscricoes_id_seq'::regclass);


--
-- Name: niveis_acesso id_nivelacesso; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.niveis_acesso ALTER COLUMN id_nivelacesso SET DEFAULT nextval('agendalocal.niveis_acesso_id_nivelacesso_seq'::regclass);


--
-- Name: tipos_registro id_tiporegistro; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.tipos_registro ALTER COLUMN id_tiporegistro SET DEFAULT nextval('agendalocal.tipos_registro_id_tiporegistro_seq'::regclass);


--
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('agendalocal.usuarios_id_usuario_seq'::regclass);


--
-- Data for Name: anuncios; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--



--
-- Data for Name: cidades; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.cidades VALUES (1, 16, 'Jataizinho');


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.clientes VALUES (2242, 1, 1, 'Agnaldo P Godoy', '3259-1339', 'Adélia Antunes Lopes, Profª, av,', '350', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2262, 1, 1, 'Álvaro A Pansardi', '3259-1465', 'Vicente Rodrigues Monteiro, tv,', '86', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2286, 1, 1, 'Antonio C Oliveira', '3259-2373', 'Paraná, av,', '103', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2234, 1, 1, 'Abelino A Goulart', '3259-3130', 'Benjamin Giavarina, av,', '814', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2235, 1, 2, 'Aceja Jataizinho', '3259-3771', 'Frei Timóteo, pç,', '77 s2', 'Associações Comerciais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2236, 1, 1, 'Adélia R Lamim', '3259-1688', 'José Moraes Neves,', '179', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2237, 1, 1, 'Adilson da Silva', '3259-2731', 'Ignácio Giavarina,', '66', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2238, 1, 1, 'Adilson G Silva', '3259-1682', 'Benjamin Giavarina, av,', '879', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2239, 1, 2, 'Adriana Munarin', '3159-0354', 'Manoel Ignácio Silva,', '37', 'Comércio Exterior - Assessoria', 0, '');
INSERT INTO agendalocal.clientes VALUES (2240, 1, 2, 'Advocacia Suely Aparecida Morro Chamilete', '3259-1362*99142-1999', 'Frei Timóteo, pç,', '43', 'Advogados', 1, '');
INSERT INTO agendalocal.clientes VALUES (2241, 1, 1, 'Afrânio C Nunes', '3259-1881', 'Getúlio Vargas, Pres, av,', '820', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2243, 1, 2, 'Agroindustrial Iguatemi', '3259-3399', 'Antonina, Br, av,', '102', 'Agro-Indústria', 0, '');
INSERT INTO agendalocal.clientes VALUES (2244, 1, 2, 'Agropecuária Jataí', '3259-2992', 'Carmela Dutra,', '328', 'Agricultura e Pecuária - Assessoria Técnica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2245, 1, 1, 'Aguinaldo Reghin', '3159-0104', 'Caetano Munhoz da Rocha, Pres, av,', '813', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2246, 1, 1, 'Akikazu Hoshi', '3259-1528', 'BR 369, Rod,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2247, 1, 1, 'Alba Furlan', '3259-1588', 'Avelino Alves Pereira, tv,', '52', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2248, 1, 1, 'Albacir Freitas', '3259-1418', 'Orlando Salles Striquer, av,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2249, 1, 1, 'Alberto Lizziero', '3259-2172', 'Benjamin Giavarina, av,', '676', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2250, 1, 1, 'Alcino R Prado Fº', '3259-1245', 'Avelino Alves Pereira, tv,', '17', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2251, 1, 1, 'Alcir M Roberto', '3259-1078', 'Thomaz Antonio Fagá,', '82', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2252, 1, 1, 'Aldemarcos de Lima', '3259-3270', 'Piquiri,', '381', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2253, 1, 1, 'Alex S Ribeiro', '3259-3860', 'Carmela Dutra,', '862', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2254, 1, 1, 'Alexandre Villas Boas', '3259-1194', 'Massahiro Inohue,', '90', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2255, 1, 1, 'Alice F Silva', '3259-1884', 'Orlando Salles Striquer, av,', '553', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2257, 1, 1, 'Aline D S Q Costa', '3259-1817', 'Juan Soares Veloso,', '284', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2258, 1, 1, 'Alisha G Oliveira', '3259-3303', 'Tibagi,', '90', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2259, 1, 2, 'Allston Brew do Brasil Indústria e Comércio', '3159-0032', 'BR 369, Rod,', 'Km128', 'Bebidas - Depósitos e Distrib', 0, '');
INSERT INTO agendalocal.clientes VALUES (2260, 1, 1, 'Almir Montecelli', '3259-1177', 'Benjamin Giavarina, av,', '440', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2261, 1, 1, 'Alvarina G Souza', '3259-2757', 'Avelino Alves Pereira, tv,', '87', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2263, 1, 1, 'Alzira V Souza', '3259-2502', 'Santos Dumont,', '454', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2264, 1, 1, 'Amadeu Y Takahashi', '3259-2321', 'Antonina, Br, av,', '518', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2265, 1, 2, 'Amigos Cred', '3259-2583', 'Juan Soares Veloso,', '206', 'Financeiras', 1, '');
INSERT INTO agendalocal.clientes VALUES (2266, 1, 1, 'Ana A Silva', '3259-2612', 'Osório Antunes Farias,', '245', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2267, 1, 1, 'Ana C B Mazaro', '3159-0000', 'John Fitzgerald Kennedy, Pres,', '736', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2268, 1, 1, 'Ana P S Ghisleri', '3159-0027', 'Valter Gomes de Faria,', '27', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2269, 1, 2, 'Anderson Almagro', '3159-0291', 'Curitiba,', '285', 'Festas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2270, 1, 1, 'Anderson C Furlan ', '3159-2724', 'Paraná, av,', '460', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2271, 1, 1, 'Anderson C P Azevedo', '3259-2139', 'Antonio Brandão de Oliveira, av,', '300', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2272, 1, 1, 'Andréa S C Semprebon', '3259-1398', 'Maranhão,', '426 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2273, 1, 1, 'Andréia V B M Vieira', '3159-2015', 'John Fitzgerald Kennedy, Pres,', '321', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2274, 1, 1, 'Andressa B Costelini', '3259-3272', 'Carmela Dutra,', '750', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2275, 1, 1, 'Andreza S Silva', '3259-2847', 'Adolfo Ausec,', '27', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2276, 1, 1, 'Anézio Pavão', '3259-1243', 'Antonio Brandão de Oliveira, av,', '580', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2277, 1, 1, 'Ângela A M Borges', '3259-1109', 'Norte, Princs,', '195', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2278, 1, 1, 'Ângela F Souza', '3159-0361', 'Castelo Branco,', '242', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2279, 1, 1, 'Ângela M S Maciel', '3259-3574', 'Orlando Salles Striquer, av,', '729', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2280, 1, 1, 'Anna L A Nery', '3159-2330', 'Antonio Mauro Fedatto,', '100', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2281, 1, 1, 'Antonia S Cruz', '3259-1384', 'Vitorina Zanini Ribeiro,', '540', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2282, 1, 1, 'Antonio A Domingues', '3259-1298', 'Antonio Brandão de Oliveira, av,', '737', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2283, 1, 1, 'Antonio Bonadiman', '3259-1483', 'Antonio Brandão de Oliveira, av,', '1347', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2284, 1, 1, 'Antonio C Castelini', '3259-1435', 'Carmela Dutra,', '874', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2285, 1, 1, 'Antonio C M Araújo', '3259-3403', 'Osório Antunes Farias,', '115', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2287, 1, 1, 'Antonio C Pansardi', '3259-2229', 'Benjamin Giavarina, av,', '95', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2288, 1, 1, 'Antonio C Silva', '3259-1541', 'Osório Antunes Farias,', '135', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2289, 1, 1, 'Antonio Ciappina', '3259-1236', 'BR 369, Rod,', 'Km1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2290, 1, 1, 'Antonio Eduardo', '3259-2243', 'Antonio Gomes Farias,', '61', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2291, 1, 1, 'Antonio G Moraes', '3259-2424', 'Osório Antunes Farias,', '85', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2292, 1, 1, 'Antonio J Vieira Jr', '3259-1378', 'Carmela Dutra,', '500 ap701', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2293, 1, 1, 'Antonio L Carvalho', '3259-3247', 'Arlindo Maeda,', '217', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2294, 1, 1, 'Antonio L Guimarães Fº', '3259-2456', 'Euzébio Monteiro,', '501', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2295, 1, 1, 'Antonio R Figueira', '3259-2954', 'Benjamin Giavarina, av,', '726', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2297, 1, 1, 'Antonio Ribeiro Neto', '3259-1319', 'Carmela Dutra,', '620', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2298, 1, 1, 'Antonio Rodrigues', '3259-1130', 'Orlando Salles Striquer, av,', '523', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2299, 1, 2, 'APAE Jataizinho', '3159-1252*3259-1251', 'Benjamin Giavarina, av,', '1232', 'Associações Beneficentes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2300, 1, 2, 'APAE Jataizinho - Setor Clínico', '3159-1253', 'Benjamin Giavarina, av,', '1232', 'Associações Beneficentes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2301, 1, 1, 'Aparecida C R Velozo', '3259-3454', 'Getúlio Vargas, Pres, av,', '684', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2302, 1, 1, 'Aparecida F Bonadiman', '3259-3744', 'Mábio Gonçalves Palhano,', '360', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2303, 1, 1, 'Aparecida G R Uliano', '3159-0098', 'Carmela Dutra,', '439 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2304, 1, 1, 'Aparecida G S Queiroz', '3259-1784', 'Vitorina Zanini Ribeiro,', '213', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2361, 1, 2, 'Cerâmica Princesa do Norte', '3259-1333', 'Joaquim Francisco Lopes,', '344', 'Cerâmica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2306, 1, 1, 'Aparecido D Almeida', '3259-2303', 'Benjamin Giavarina, av,', '640', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2307, 1, 2, 'APM Colégio Estadual Prof Pedro Viriato Parigot Souza', '3259-2165', 'Nicola Pansardi, av,', '325', 'Escolas Públicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2308, 1, 1, 'Armando J Neves', '3159-0248', 'Piquiri,', '648', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2309, 1, 1, 'Armando Silva', '3259-1375', 'Benjamin Giavarina, av,', '209', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2310, 1, 2, 'Armarinhos Itália', '3259-1599', 'Juan Soares Veloso,', '186', 'Armarinhos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2311, 1, 1, 'Arnaud R Nogueira', '3259-3194', 'Vitorina Zanini Ribeiro,', '511', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2312, 1, 1, 'Augusto T Hoshino', '3259-2185', 'Antonina, Br, av,', '414', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2313, 1, 1, 'Aurilene C Souza', '3259-3064', 'Santo Cardim,', '45', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2315, 1, 2, 'Auto Elétrica Kubo', '3259-1486', 'Caetano Munhoz da Rocha, Pres, av,', '524', 'Auto Elétricos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2316, 1, 2, 'Auto Escola Bella Cidade', '3259-3587', 'Benjamin Giavarina, av,', '357', 'Auto Escolas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2317, 1, 2, 'Auto Mecânica Lando', '3259-3050', 'João Silva,', '539', 'Oficinas Mecânicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2318, 1, 2, 'Auto Mecânica Lopes Car', '3259-2744', 'Caetano Munhoz da Rocha, Pres, av,', '701', 'Oficinas Mecânicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2319, 1, 2, 'Auto Mecânica Sérgio', '3159-0268*3259-2251', 'Caetano Munhoz da Rocha, Pres, av,', '860', 'Mecânica Industrial', 0, '');
INSERT INTO agendalocal.clientes VALUES (2320, 1, 2, 'Auto Posto BR 369', '3259-2488', 'Caetano Munhoz da Rocha, Pres, av,', '915', 'Postos de Combustíveis e Serviços', 0, '');
INSERT INTO agendalocal.clientes VALUES (2321, 1, 2, 'Auto Posto Jatay', '3259-1148*3259-3322', 'Caetano Munhoz da Rocha, Pres, av,', '467', 'Postos de Combustíveis e Serviços', 0, '');
INSERT INTO agendalocal.clientes VALUES (2322, 1, 2, 'Banco Bradesco', '3259-1610', 'Getúlio Vargas, Pres, av,', '645', 'Bancos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2323, 1, 2, 'Banco do Brasil S/A', '3259-1140', 'Carmela Dutra,', '444', 'Bancos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2324, 1, 2, 'Bar do Bi', '3159-4949', 'Benjamin Giavarina, av,', '394', 'Bares', 0, '');
INSERT INTO agendalocal.clientes VALUES (2325, 1, 1, 'Bartolo B Martins', '3259-3627', 'Benjamin Giavarina, av,', '1049', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2326, 1, 2, 'Bazar do Bodão', '3259-1886', 'John Fitzgerald Kennedy, Pres,', '282', 'Bazares', 0, '');
INSERT INTO agendalocal.clientes VALUES (2327, 1, 1, 'Benedita F Custódio', '3259-2796', 'Potiguar de Medeiros,', '62 c2', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2328, 1, 1, 'Benedito Pires', '3259-3877', 'Tânia Lúcia Correia,', '128', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2329, 1, 1, 'Benício Pereira', '3259-2281', 'Getúlio Vargas, Pres, av,', '615 ap22', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2330, 1, 1, 'Benito M Galli', '3159-0739', 'Benjamin Giavarina, av,', '491', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2331, 1, 2, 'Bitt Informática', '3259-3706', 'Monteiro Lobato,', '669', 'Informática - Equip - Assistência Técnica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2332, 1, 2, 'Boneco Filme Estética Automotiva', '3259-2356', 'Benjamin Giavarina, av,', '743', 'Automóveis - Lavagem e Polimento', 0, '');
INSERT INTO agendalocal.clientes VALUES (2333, 1, 2, 'Brasil Ferro e Aço', '3259-2792', 'Caetano Munhoz da Rocha, Pres, av,', '680', 'Ferro', 0, '');
INSERT INTO agendalocal.clientes VALUES (2334, 1, 2, 'Caixa Aqui', '3159-0084', 'Carmela Dutra,', '555', 'Bancos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2335, 1, 2, 'Câmara Municipal de Jataizinho', '3259-2217', 'Antonio Brandão de Oliveira, av,', '599', 'Câmaras Municipais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2336, 1, 1, 'Carina D M Ramos', '3259-1156', 'Euzébio Monteiro,', '422', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2337, 1, 1, 'Carlos A T Beraldi', '3259-1545', 'BR 369, Rod,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2338, 1, 2, 'Carlos D Almeida', '3259-3559', 'Benjamin Giavarina, av,', '650', 'Eletrônica - Consertos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2339, 1, 1, 'Carlos Fernandes', '3259-2196', 'Getúlio Vargas, Pres, av,', '330', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2340, 1, 1, 'Carlos Garavello', '3259-1264', 'Antonio Brandão de Oliveira, av,', '312', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2341, 1, 1, 'Carlos K Hoshino', '3259-2953', 'Antonina, Br, av,', '518', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2342, 1, 1, 'Carlos S Silva', '3259-2405', 'Norte, Princs,', '47', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2343, 1, 2, 'Casa Abrigo de Jataizinho', '3159-0400', 'Joaquim Francisco Lopes,', '362', 'Lares e Abrigos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2344, 1, 2, 'Casa de Carnes Boi de Ouro', '3259-1841*98429-8256', 'Antonio Brandão de Oliveira, av,', '1310', 'Açougues', 1, '');
INSERT INTO agendalocal.clientes VALUES (2345, 1, 2, 'Casa de Rações II Irmãos', '3259-2923*99661-8563', 'Orlando Salles Striquer, av,', '670', 'Banho e Tosa', 1, '');
INSERT INTO agendalocal.clientes VALUES (2346, 1, 1, 'Catarina O Santos', '3259-1526', 'Benjamin Giavarina, av,', '589', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2347, 1, 1, 'Cecília Casagrande', '3259-2741', 'Orlando Salles Striquer, av,', '431', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2348, 1, 2, 'Celeiro Comércio de Produtos Agropecuária', '3259-1254', 'Antonio Brandão de Oliveira, av,', '435 ljA', 'Agro-Indústria', 0, '');
INSERT INTO agendalocal.clientes VALUES (2349, 1, 1, 'Célia Alves', '3259-1297', 'Joaquim Francisco Lopes,', '985', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2350, 1, 1, 'Célia B B Martins', '3259-1437', 'Carmela Dutra,', '500 ap501', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2351, 1, 1, 'Celiane A M Lima', '3259-1927', 'Benjamin Giavarina, av,', '921', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2352, 1, 1, 'Célio Leite', '3259-1220', 'Orlando Salles Striquer, av,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2353, 1, 1, 'Celso Batista', '3259-2115', 'Antonio Moreno Eggéia,', '40', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2354, 1, 1, 'Cenira A Rafaelli', '3259-2118', 'João Silva,', '494', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2356, 1, 2, 'Centro de Convivência para Idosos Jacomino Pansardi', '3259-3855', 'Oswaldo Pansardi,', '83', 'Serviços Sociais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2357, 1, 2, 'Centro de Educação Infantil Ieda Garcia Tanaka', '3259-3854', 'Paraná, av,', '1000', 'Escolas de Educação Infantil (Maternal, Jardim e Pré-Escola)', 0, '');
INSERT INTO agendalocal.clientes VALUES (2358, 1, 2, 'Centro de Referência de Assistência Social - CRAS', '3259-2207', 'Antonio Pavão,', '15', 'Serviços Sociais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2359, 1, 2, 'Cerâmica Brasil', '3259-1173*3259-1284', 'BR 369, Rod,', 'Km128', 'Cerâmica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2360, 1, 2, 'Cerâmica Planalto Ltda', '3259-1202', 'BR 369, Rod,', 'Km128', 'Cerâmica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2362, 1, 2, 'Cerâmica Tropical', '3259-1543', 'Paraná, av,', '1', 'Cerâmica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2363, 1, 1, 'Cezira F Semprebom', '3259-2836', 'Joaquim Francisco Lopes,', '715', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2364, 1, 2, 'Chaveiro e Relojoaria Orient', '3259-3318*99175-6652', 'Antonio Brandão de Oliveira, av,', '832', 'Chaveiros', 1, '');
INSERT INTO agendalocal.clientes VALUES (2365, 1, 1, 'Cícero A Guimarães', '3259-2911', 'Paraná, av,', '437', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2366, 1, 1, 'Cícero L Oliveira', '3259-3584', 'Oswaldo Zanini,', '19', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2367, 1, 1, 'Cilce Aguiar', '3259-3467', 'Piquiri,', '693', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2368, 1, 1, 'Ciro B Lima', '3259-1249', 'Massahiro Inohue,', '56', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2369, 1, 1, 'Clarice C Martieno', '3259-2426', 'Curitiba,', '184', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2370, 1, 1, 'Claudete A Oliveira', '3259-2733', 'Avelino Alves Pereira, tv,', '73', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2371, 1, 1, 'Claudete L Martins', '3259-3545', 'Guanabara,', '135 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2402, 1, 2, 'Deborah T R Cordeiro', '3259-1168', 'Antonio Brandão de Oliveira, av,', '537', 'Cirurgiões Dentistas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2437, 1, 1, 'Edinei M Prado', '3259-2958', 'Potiguar de Medeiros,', '52', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2374, 1, 1, 'Claudionor S Oliveira', '3259-2949', 'Antonio R G Correia,', '27', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2375, 1, 1, 'Claurice S Maximo', '3259-3140', 'Osório Antunes Farias,', '357', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2376, 1, 1, 'Clayton S Carneiro', '3259-2783', 'Osório Antunes Farias,', '46', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2377, 1, 1, 'Cleonice A S Ferreira', '3259-2935', 'Ayrton Senna da Silva,', '217', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2378, 1, 1, 'Cleusa M Santos', '3259-2905', 'Nicola Pansardi, av,', '538 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2379, 1, 1, 'Cleusa P Lacerda', '3259-1794', 'Norte, Princs,', '55 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2380, 1, 1, 'Cleuza M S Ferreira', '3259-1013', 'Monteiro Lobato,', '390', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2381, 1, 2, 'Clínica Veterinária Dani Home Vet', '3259-2443*99857-2035', 'Orlando Salles Striquer, av,', '511', 'Veterinários - Médicos', 1, '');
INSERT INTO agendalocal.clientes VALUES (2382, 1, 2, 'Colégio Estadual Profª Adélia Antunes Lopes', '3259-2763', 'Monteiro Lobato,', '730', 'Escolas Públicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2383, 1, 2, 'Colônia de Pescadores Z-3 de Jataizinho', '3259-1009', 'Curitiba,', '17', 'Pesca Artesanal', 0, '');
INSERT INTO agendalocal.clientes VALUES (2384, 1, 2, 'Comercial Ausec', '3159-0105', 'Nicola Pansardi, av,', '461', 'Materiais de Construção - Lojas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2385, 1, 1, 'Conceição A Lacerda', '3259-1240', 'Nicola Pansardi, av,', '332', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2386, 1, 1, 'Conceição O Arruda', '3259-3841', 'Avelino Alves Pereira, tv,', 'lt38A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2387, 1, 2, 'Construtora Galisa e Tostes', '3159-1260', 'João Silva,', '436', 'Construtores', 0, '');
INSERT INTO agendalocal.clientes VALUES (2388, 1, 2, 'Consultório Odontológico Andressa Bernal', '3159-0395*3259-2626', 'Antonio Brandão de Oliveira, av,', '497', 'Cirurgiões Dentistas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2389, 1, 2, 'Creche Inácia Duilio Duarte', '3259-1167', 'Minas Gerais,', 's/n', 'Creches', 0, '');
INSERT INTO agendalocal.clientes VALUES (2390, 1, 2, 'Creche Santa Luzia', '3259-1397', 'Oswaldo Pansardi,', '27', 'Creches', 0, '');
INSERT INTO agendalocal.clientes VALUES (2391, 1, 1, 'Cristiane C Batista', '3159-0137', 'Antonio Moreno Eggéia,', '95', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2392, 1, 1, 'Cristiane G Maciel', '3259-1369', 'Pedro de Alcântara, S,', '204', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2393, 1, 1, 'Cristiane M Santos', '3159-0053', 'Joaquim Francisco Lopes,', '141', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2394, 1, 2, 'Cristiane S Hoshino', '3259-3181', 'Getúlio Vargas, Pres, av,', '615 s3', 'Roupas Femininas - Lojas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2395, 1, 1, 'Daiany J O Caus', '3259-1841', 'Antonio Mauro Fedatto,', '26', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2396, 1, 1, 'Damázio F Bonfim', '3159-0312', 'Pedro II, D,', '358 ap11 bl1 ', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2397, 1, 1, 'Daniel B Todesco', '3259-2136', 'Daniel Pucca,', '190', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2398, 1, 1, 'Daniel Pucca', '3259-1185', 'Monteiro Lobato,', '803', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2399, 1, 1, 'David G Corsino', '3259-2263', 'Piquiri,', '381', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2400, 1, 1, 'Dayani M L Lopes', '3259-3615', 'Benjamin Giavarina, av,', '891', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2401, 1, 1, 'Debier H D Tavares', '3259-3063', 'Nicola Pansardi, av,', '398', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2403, 1, 2, 'Delegacia de Polícia Civil', '3259-1490', 'Joaquim Francisco Lopes,', '303', 'Delegacias e Distritos Policiais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2404, 1, 1, 'Delícia R Marques', '3259-2735', 'Massahiro Inohue,', '99', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2405, 1, 1, 'Denise Anjos', '3259-2158', 'Pedro de Alcântara, S,', '171', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2406, 1, 1, 'Deozelina J T Lourenço', '3259-1083', 'John Fitzgerald Kennedy, Pres,', '766', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2407, 1, 2, 'Departamento de Assistência Social de Jataizinho', '3259-3742', 'Benjamin Giavarina, av,', '469', 'Órgãos Públicos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2408, 1, 2, 'Depósito Azevedo Comercial', '3259-1000', 'BR 369, Rod,', 'Km129', 'Materiais de Construção - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2409, 1, 2, 'Depósito Jatay', '3259-1527', 'Paraná, av,', '887', 'Materiais de Construção - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2410, 1, 2, 'Depósito Santa Mônica', '3259-3136', 'Antonio Brandão de Oliveira, av,', '1340', 'Materiais de Construção - Lojas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2411, 1, 2, 'Depósito Tibagi', ' 3259-3317*3259-1116 / 3259-1233', 'Carmela Dutra,', '499', 'Materiais de Construção - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2412, 1, 1, 'Dezia C Andrade', '3259-1123', 'Monteiro Lobato,', '669', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2413, 1, 2, 'Diego B Lucas', '3259-3226', 'Getúlio Vargas, Pres, av,', '605', 'Açougues', 0, '');
INSERT INTO agendalocal.clientes VALUES (2414, 1, 1, 'Diego J Santos', '3159-0013', 'Adélia Antunes Lopes, Profª, av,', '47', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2415, 1, 1, 'Diego S Mendes', '3259-3648', 'Joaquim Francisco Lopes,', '1006', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2416, 1, 2, 'Digitech', '3259-3559', 'Benjamin Giavarina, av,', '650', 'Eletrônica - Consertos', 1, '');
INSERT INTO agendalocal.clientes VALUES (2417, 1, 1, 'Dilene M Aguiar', '3159-0316', 'Monteiro Lobato,', '429 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2418, 1, 1, 'Dinalva S Silva', '3259-2761', 'Tiradentes,', '211', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2419, 1, 1, 'Dionilde Fabri', '3259-2205', 'Joaquim Francisco Lopes,', '692', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2420, 1, 1, 'Diorges O Lima', '3259-3427', 'Luiz Sanzovo,', '56', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2421, 1, 1, 'Dirceu Antunes', '3259-2572', 'Massahiro Inohue,', '166', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2422, 1, 2, 'Distribuidora de Gás Top Gás Ltda', '3259-2000', 'Paraná, av,', '1085', 'Gás - Fornecedores', 0, '');
INSERT INTO agendalocal.clientes VALUES (2423, 1, 2, 'Distribuidora de Móveis Pelisson Ltda', '3159-0041', 'Carmela Dutra,', '416', 'Móveis - Lojas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2424, 1, 2, 'DJA Móveis', '3259-1614', 'Henrique Machado dos Santos,', '16', 'Marcenarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2425, 1, 1, 'Dolores F Carvalheiro', '3259-1605', 'Euzébio Monteiro,', '634 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2427, 1, 2, 'Donna Flor', '3259-3181*98413-7505', 'Getúlio Vargas, Pres, av,', '615 s3', 'Roupas Femininas - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2428, 1, 1, 'Doraci S Marchi', '3259-2381', 'Caetano Munhoz da Rocha, Pres, av,', '361', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2429, 1, 1, 'Dorival P Souza', '3259-2539', 'Santo Cardim,', '146', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2430, 1, 1, 'Douglas Dornelas', '3259-3691', 'Paraná, av,', '1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2431, 1, 1, 'Douglas S Bittencourt', '3159-0335', 'Avelino Alves Pereira, tv,', '100', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2432, 1, 2, 'Dulcelina O C Scussel', '3259-1400', 'John Fitzgerald Kennedy, Pres,', '150', 'Casas de Repouso', 0, '');
INSERT INTO agendalocal.clientes VALUES (2433, 1, 1, 'Dulcinéia S Silva', '3259-3014', 'Cândida Alves Queirós,', '196', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2434, 1, 2, 'Eder J Zatte', '3259-2125', 'Carmela Dutra,', '330', 'Motocicletas - Peças, Lojas e Serviços', 0, '');
INSERT INTO agendalocal.clientes VALUES (2435, 1, 1, 'Eder Oliveira', '3259-3836', 'Minoru Goto,', '45', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2436, 1, 2, 'Edgard H Hoshi', '3259-2895', 'Getúlio Vargas, Pres, av,', '580', 'Pet Shop', 0, '');
INSERT INTO agendalocal.clientes VALUES (2438, 1, 1, 'Edinei S Morais', '3259-2597', 'Piauí,', '42', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2439, 1, 1, 'Edinéia R L Teles', '3259-3166', 'Santo Cardim,', '76', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2440, 1, 1, 'Édipo A S Silva', '3259-1514', 'Augusta Vilaça Silva,', '52', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2442, 1, 1, 'Edith B Kubo', '3259-2167', 'Norte, Princs,', '400', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2443, 1, 1, 'Edmilson D Silva', '3259-2966', 'Antonio Pádua Correia,', '39', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2444, 1, 1, 'Edna G C Maia', '3259-2129', 'Antonina, Br, av,', '687', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2445, 1, 1, 'Edna N O Azevedo', '3259-1094', 'Augusta Vilaça Silva,', '23', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2446, 1, 1, 'Ednei S Laurindo', '3259-3188', 'Santo Cardim,', '531', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2447, 1, 1, 'Elcio A Pinto', '3259-2265', 'Getúlio Vargas, Pres, av,', '333', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2448, 1, 1, 'Eleny M Silva', '3259-1601', 'José Fidelis Filho,', '63', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2449, 1, 1, 'Eliana A B Kawata', '3259-3832', 'John Fitzgerald Kennedy, Pres,', '531', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2450, 1, 1, 'Eliane L Marond', '3259-3141', 'Santo Cardim,', '534', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2452, 1, 1, 'Eliezer A Bonfim', '3259-2611', 'Pedro II, D,', '237', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2453, 1, 1, 'Elisdiani M Muchim', '3159-0301', 'Tânia Lúcia Correia,', '84', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2454, 1, 1, 'Eloísio A Ferreira', '3159-0163', 'Massahiro Inohue,', '121', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2455, 1, 2, 'Emater - Instituto Paranaense de Assistência Técnica e Extensão Rural', '3259-1548', 'Oswaldo Pansardi,', '12', 'Agricultura e Pecuária - Assessoria Técnica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2456, 1, 1, 'Emice A Silva', '3259-1300', 'Santo Cardim,', '541', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2457, 1, 1, 'Emídio E Bertagnoli', '3259-2184', 'Castelo Branco,', '230', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2458, 1, 2, 'Empresa Brasileira de Correios e Telégrafos', '3259-2166', 'Benjamin Giavarina, av,', '57', 'Correios e Telégrafos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2459, 1, 2, 'Empresa Concessionária de Rodovias do Norte S/A Econorte', '3259-2398', 'BR 369, Rod,', 'Km126', 'Rodovias - Administração', 0, '');
INSERT INTO agendalocal.clientes VALUES (2460, 1, 1, 'Encarnação C B Costelini', '3259-3796', 'Antonio Brandão de Oliveira, av,', '497', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2461, 1, 1, 'Eneval Pereira', '3259-1906', 'Norberto Camargo Lemos,', '27', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2462, 1, 1, 'Eric B Silva', '3159-0180', 'Carmela Dutra,', '398', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2463, 1, 1, 'Ernita P Santos', '3259-3786', 'Minas Gerais,', '206', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2464, 1, 2, 'Escola Cantinho Feliz Matriarca', '3259-1918', 'Antonio Mauro Fedatto,', '67', 'Escolas de Educação Infantil (Maternal, Jardim e Pré-Escola)', 0, '');
INSERT INTO agendalocal.clientes VALUES (2465, 1, 2, 'Escola Municipal Princesa Isabel', '3259-3373', 'Antonio Gomes Farias,', '121', 'Escolas Municipais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2466, 1, 2, 'Escola Municipal Wilson Chamilete', '3259-3896', 'Oswaldo Pansardi,', '64', 'Escolas Municipais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2467, 1, 2, 'Escritório Contábil Oxford', '3159-1019*3259-1019', 'Antonio Brandão de Oliveira, av,', '598', 'Contabilidade - Escritórios', 1, '');
INSERT INTO agendalocal.clientes VALUES (2468, 1, 2, 'Estefano Informática', '3259-3631', 'Antonio Brandão de Oliveira, av,', '558', 'Informática - Art, Equip e Suprimentos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2469, 1, 1, 'Estevam B Baena', '3259-1448', 'Getúlio Vargas, Pres, av,', '590', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2470, 1, 2, 'Estopas Tibagi Ind e Com Ltda - ME', '3259-3000', 'BR 369, Rod,', '2405', 'Estopas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2471, 1, 1, 'Eudete S Aguiar', '3259-1736', 'Pedro de Alcântara, S,', '109', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2472, 1, 1, 'Eufrásio S Velozo', '3259-1268', 'Joaquim Francisco Lopes,', '162', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2473, 1, 1, 'Eugênio Kwasnitza', '3259-1560', 'Benjamin Giavarina, av,', '1192', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2474, 1, 1, 'Eunice Pansardi', '3259-1540', 'Joaquim Francisco Lopes,', '347', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2475, 1, 1, 'Eunice T Souza', '3259-1925', 'João Silva,', '270', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2476, 1, 1, 'Eurides N Soares', '3259-2944', 'Orlando Salles Striquer, av,', '749', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2477, 1, 1, 'Euzímio Morro', '3259-2413', 'Norberto Camargo Lemos,', '6', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2478, 1, 1, 'Eva G Silva', '3259-1107', 'Monteiro Lobato,', '551', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2479, 1, 1, 'Eva P Silva', '3259-2546', 'Antonio Vergílio Furlan,', '46', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2480, 1, 1, 'Everson Ludvig', '3159-0062', 'Paraná, av,', '117', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2481, 1, 1, 'Expedita B Santos', '3259-3103', 'Paraná, av,', '67', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2482, 1, 1, 'Fabiano C Fidelis', '3259-1911', 'José Alves,', '67', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2484, 1, 2, 'Fabri Micro Empresa', '3259-2598', 'Benjamin Giavarina, av,', '83', 'Empreendimentos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2485, 1, 2, 'Farmácia Avenida', '3259-1255*3259-2571', 'Antonio Brandão de Oliveira, av,', '425', 'Farmácias e Drogarias', 1, '');
INSERT INTO agendalocal.clientes VALUES (2486, 1, 2, 'Farmácia Drogamais', '3159-2310*3259-2310', 'Getúlio Vargas, Pres, av,', '510', 'Farmácias e Drogarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2487, 1, 2, 'Farmácia Forte Farma', '3259-3462', 'Carmela Dutra,', '558', 'Farmácias e Drogarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2488, 1, 2, 'Farmácia Santa Terezinha', '3259-1622*3259-3837', 'Carmela Dutra,', '352', 'Farmácias e Drogarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2489, 1, 1, 'Fernando A Ribeiro', '3259-1626', 'BR 369, Rod,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2490, 1, 1, 'Fernando E Vieira', '3259-2996', 'Benjamin Giavarina, av,', '345 c1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2491, 1, 1, 'Francieli B Silvério', '3259-2214', 'Adélia Antunes Lopes, Profª, av,', '394', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2492, 1, 1, 'Francielly A B Souza', '3259-3443', 'Konji Kubo,', '36', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2493, 1, 1, 'Francielly F G Silva', '3259-1856', 'João Silva,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2494, 1, 1, 'Franciely B Silveiro', '3159-0028', 'Vicente Rodrigues Monteiro, tv,', '37', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2495, 1, 1, 'Francisca A C Pereira', '3259-2821', 'Massamo Inohue,', '67', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2496, 1, 1, 'Francisco C Silva', '3259-1587', 'Sebastião Vieira Costa, tv,', '34', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2497, 1, 1, 'Francisco Mizael Fº', '3259-1340', 'Piquiri,', '270', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2498, 1, 1, 'Francisco Moreira', '3259-1382', 'Antonina, Br, av,', '795', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2499, 1, 1, 'Francisco Moreira Fº', '3259-2810', 'Mábio Gonçalves Palhano,', '96', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2500, 1, 1, 'Francisco P Souza', '3259-3882', 'Roque Conduta,', '116', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2501, 1, 1, 'Francisco T Carvalho Jr', '3259-3311', 'Piauí,', '245', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2502, 1, 2, 'Frango Frito Vieira', '3259-1846', 'Caetano Munhoz da Rocha, Pres, av,', 's/n', 'Restaurantes', 1, '');
INSERT INTO agendalocal.clientes VALUES (2503, 1, 2, 'Funerária Bom Pastor', '3259-2282', 'Antonio Brandão de Oliveira, av,', '175', 'Funerárias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2505, 1, 2, 'Funerária São José', '3159-0270', 'Antonio Brandão de Oliveira, av,', '816', 'Funerárias - Planos', 1, '');
INSERT INTO agendalocal.clientes VALUES (2506, 1, 1, 'Genésio Merlim', '3259-1386', 'Norte, Princs,', '193', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2507, 1, 1, 'Geni O Antunes', '3259-2182', 'Joaquim Francisco Lopes,', '562', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2508, 1, 1, 'Geovania A Fabri', '3259-2327', 'Konji Kubo,', '65', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2509, 1, 1, 'Geraldo F Silva', '3259-2218', 'Benjamin Giavarina, av,', '1330', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2510, 1, 1, 'Geraldo Martini', '3159-2448', 'Caetano Munhoz da Rocha, Pres, av,', 'Km369 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2512, 1, 1, 'Giacomino Pansardi Jr', '3259-2745', 'Getúlio Vargas, Pres, av,', '716', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2513, 1, 1, 'Gilberto G Silva', '3259-1348', 'Carmela Dutra,', '755', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2514, 1, 1, 'Gilberto Palierini', '3259-3652', 'Paul Perci Harris,', 'lt17', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2515, 1, 1, 'Giorgio Yamamoto', '3259-2266', 'Antonio Pádua Correia,', '128', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2516, 1, 2, 'Gleicy E Zacheo', '3259-1110', 'Paraná, av,', '1075', 'Farmácias e Drogarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2517, 1, 1, 'Glória M Tarosso', '3259-2901', 'Joaquim Francisco Lopes,', '1340', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2519, 1, 1, 'Gonçalo F Antonio', '3259-2677', 'Monteiro Lobato,', '679', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2520, 1, 1, 'Guido Contato', '3259-1153', 'Nicola Pansardi, av,', '270', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2521, 1, 1, 'Guilherme X Silva', '3259-3805', 'Pedro Geremias Marques,', '17', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2522, 1, 1, 'Guiomar F Basílio', '3259-2509', 'Oswaldo Zanini,', '46', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2523, 1, 1, 'Gumercindo Quitério', '3259-1137', 'BR 369, Rod,', 'Km128', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2524, 1, 1, 'Gustavo A Pinto', '3259-3170', 'Getúlio Vargas, Pres, av,', '333', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2525, 1, 2, 'H Fernando de Freitas & Cia Ltda', '3158-0007', 'Vicente Rodrigues Monteiro, tv,', '473 s1', 'Bancos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2526, 1, 1, 'Haruo Hoshino', '3259-1203', 'Antonio Brandão de Oliveira, av,', '625', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2527, 1, 1, 'Heitor V Martins', '3259-1312', 'John Fitzgerald Kennedy, Pres,', '245', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2528, 1, 1, 'Helder A Boscolo', '3259-2869', 'Olga Giovana Françoso,', '97', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2529, 1, 1, 'Helena A S Brandão', '3259-2838', 'Carmela Dutra,', '600', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2530, 1, 1, 'Hélio S Cardim', '3259-2240', 'Caetano Munhoz da Rocha, Pres, av,', '351', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2531, 1, 1, 'Hélio Suzigan', '3259-2765', 'Antonio Pádua Correia,', '53', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2532, 1, 2, 'Heloisa Vieira Pinto Armarinhos ME', '3259-1600', 'Carmela Dutra,', '439', 'Armarinhos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2533, 1, 1, 'Hilda C Santos', '3259-2602', 'John Fitzgerald Kennedy, Pres,', '491', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2534, 1, 1, 'Hiroschiy Kubo', '3259-1537', 'João Silva,', '575', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2535, 1, 1, 'Hiroshi Hoshino', '3259-2339', 'João Silva,', '308', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2536, 1, 1, 'Hiroshi Sato', '3259-1557', 'Antonio Brandão de Oliveira, av,', '854', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2537, 1, 2, 'Hospital São Camilo Ltda', '3259-1315', 'Antonio Brandão de Oliveira, av,', '1275', 'Hospitais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2538, 1, 2, 'Hotel Água Branca Ltda', '3159-2000', 'Caetano Munhoz da Rocha, Pres, av,', 'Km128', 'Hotéis', 0, '');
INSERT INTO agendalocal.clientes VALUES (2539, 1, 1, 'Hugo L T Waizumi', '3259-3789', 'Massahiro Inohue,', '118', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2540, 1, 1, 'Humberto R Camargo', '3259-1876', 'Avelino Alves Pereira, tv,', '25', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2541, 1, 2, 'IBICELL', '3259-2654', 'Antonio Brandão de Oliveira, av,', '436', 'Telefonia Móvel Celular', 0, '');
INSERT INTO agendalocal.clientes VALUES (2542, 1, 1, 'Icléia M Palhano', '3259-1505', 'Joaquim Francisco Lopes,', '223', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2543, 1, 1, 'Iclemeir M Leme', '3259-2641', 'José Fidelis Filho,', '106', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2544, 1, 1, 'Idalina A B Silva', '3259-2754', 'Donizete Pinto Brandão,', '108', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2545, 1, 1, 'Ilda F Martins', '3259-1038', 'Antonina, Br, av,', '948', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2546, 1, 1, 'Ilena M Andrade', '3259-2725', 'Orlando Salles Striquer, av,', '411', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2547, 1, 1, 'Inalda M L Pereira', '3259-2575', 'Vitorina Zanini Ribeiro,', '46', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2548, 1, 1, 'Inês A Pereira', '3259-2640', 'Monteiro Lobato,', '840', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2549, 1, 1, 'Inês Pansardi', '3259-1443', 'Joaquim Francisco Lopes,', '228', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2550, 1, 1, 'Inês S Silva', '3259-3658', 'Vitorina Zanini Ribeiro,', '354', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2551, 1, 1, 'Inis F F Marques', '3259-2344', 'Caetano Munhoz da Rocha, Pres, av,', '840', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2552, 1, 1, 'Ione Oikawa', '3259-1301', 'Benjamin Giavarina, av,', '37', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2553, 1, 1, 'Iorides B P Bissi', '3259-1759', 'Joaquim Francisco Lopes,', '890', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2554, 1, 1, 'Iraci Cosso', '3259-3219', 'Antonina, Br, av,', '957', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2555, 1, 1, 'Iraci F Melo', '3259-3651', 'Benjamin Giavarina, av,', '866', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2556, 1, 1, 'Iraci Nunes', '3259-2457', 'Piauí,', '42 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2558, 1, 2, 'Irmãos Bernal Ltda - EPP', '3259-1370', 'Piquiri,', '62', 'Cerâmicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2559, 1, 1, 'Isabel K F Kikuchi', '3259-2357', 'Tiradentes,', '227', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2560, 1, 1, 'Ismael R Silva', '3259-1068', 'Pedro II, D,', '378', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2561, 1, 2, 'Ivan Taiatele', '3159-0054', 'Caetano Munhoz da Rocha, Pres, av,', '380', 'Tapeçarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2562, 1, 1, 'Ivanilde B Cardin', '3259-1320', 'Caetano Munhoz da Rocha, Pres, av,', '336', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2563, 1, 1, 'Ivete B O Martielho', '3259-2392', 'Massamo Inohue,', '88', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2564, 1, 1, 'Ivone B Souza', '3259-2837', 'Curitiba,', '194', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2565, 1, 1, 'Ivone P Medeiros', '3259-3398', 'Benjamin Giavarina, av,', '951 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2566, 1, 1, 'Izabel F B Rafaeli', '3259-1803', 'Paraná, av,', '700', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2567, 1, 1, 'Izabel S Oliveira', '3259-2693', 'Antonio Gomes Farias,', '60', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2568, 1, 1, 'Izopero Pires', '3259-2585', 'José Fidelis Filho,', '70', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2569, 1, 1, 'Jairo G Silva', '3259-2545', 'Joaquim Francisco Lopes,', '477', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2570, 1, 1, 'Janete A S Azevedo', '3259-2758', 'Ignácio Giavarina,', '21', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2571, 1, 1, 'Jaqueline S Miranda', '3259-2701', 'Benjamin Giavarina, av,', '394 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2572, 1, 2, 'Jatay Gás e Água', '3259-1326*3159-1326 / 98827-0941', 'Pedro II, D,', '229', 'Gás - Fornecedores', 1, '');
INSERT INTO agendalocal.clientes VALUES (2573, 1, 1, 'João B Bruno', '3259-1303', 'Antonio Brandão de Oliveira, av,', '948', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2574, 1, 1, 'João B Leite', '3259-1686', 'Norte, Princs,', '84', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2575, 1, 1, 'João B Pedrosa', '3259-2008', 'Pedreira,', '231', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2576, 1, 1, 'João C A Freitas', '3259-3596', 'Vitorina Zanini Ribeiro,', '212', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2577, 1, 1, 'João C D Alberguine', '3159-0035', 'Antonina, Br, av,', '1025', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2578, 1, 1, 'João F Pereira', '3259-2672', 'Benjamin Giavarina, av,', '1146', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2579, 1, 1, 'João M C Santana', '3259-1416', 'Frei Timóteo, pç,', '171', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2580, 1, 1, 'João M Pinto', '3259-1999', 'Benjamin Giavarina, av,', '1124', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2581, 1, 1, 'João Pinto Fº', '3259-1102', 'Carmela Dutra,', '500 ap402 and4', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2582, 1, 1, 'João R Cruz', '3259-3082', 'Bahia,', '255', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2583, 1, 1, 'João S Cavalcante', '3259-1636', 'Nicola Pansardi, av,', '979', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2584, 1, 1, 'Joaquim J R Terra', '3259-1317', 'João Silva,', '470', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2585, 1, 1, 'Jociane F Padilha', '3159-0356', 'Benjamin Giavarina, av,', '886', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2604, 1, 1, 'José L Coelho', '3259-2106', 'Benjamin Giavarina, av,', '708', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2617, 1, 1, 'Josemar C Ribeiro', '3259-2429', 'Antonio Moreno Eggéia,', '132', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2587, 1, 1, 'Joel M Santos', '3259-2596', 'Orlando Salles Striquer, av,', '669', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2588, 1, 1, 'Joel O Fidelis', '3259-1414', 'Nicola Pansardi, av,', '619', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2589, 1, 1, 'Jorge Shimizo', '3259-1501', 'Carmela Dutra,', '839', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2590, 1, 2, 'Jorge T Yamamoto', '3259-1305', 'John Fitzgerald Kennedy, Pres,', '225', 'Oficinas Mecânicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2591, 1, 1, 'José A A Cunha', '3259-2009', 'Nicola Pansardi, av,', '170 c1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2592, 1, 1, 'José A Almagro', '3259-1532', 'BR 369, Rod,', 'Km129', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2593, 1, 1, 'José A Moraes', '3259-3424', 'Konji Kubo,', '117', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2594, 1, 1, 'José A V Marques', '3259-1308', 'Antonina, Br, av,', '962', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2595, 1, 1, 'José C Costa', '3259-2787', 'Luiz Sanzovo,', '69', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2596, 1, 1, 'José C Silva', '3259-1637', 'Frei Timóteo, pç,', '1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2597, 1, 2, 'José Carlos Táxi ', '99103-8123*99639-0336', 'Frei Timóteo, pç,', 's/n', 'Táxis', 1, '');
INSERT INTO agendalocal.clientes VALUES (2598, 1, 1, 'José D G Costa', '3259-2298', 'Benjamin Giavarina, av,', '1065', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2599, 1, 1, 'José Dascheve', '3259-1280', 'Antonio Gomes Farias,', '150', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2600, 1, 1, 'José E F Pinto', '3259-1687', 'Nicola Pansardi, av,', '205', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2602, 1, 2, 'José G Beccheri', '3259-2522', 'Antonio Brandão de Oliveira, av,', '1097', 'Gráficas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2603, 1, 1, 'José G Fernandes', '3259-1466', 'João Silva,', '485', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2605, 1, 1, 'José M Aguiar', '3259-2812', 'Benjamin Giavarina, av,', '611', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2606, 1, 1, 'José M Silva', '3259-2795', 'Nicola Pansardi, av,', '726', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2607, 1, 1, 'José N Morro', '3259-1888', 'Frei Timóteo, pç,', '37', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2608, 1, 1, 'José O Mayo', '3259-3638', 'José Alves,', '151', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2609, 1, 1, 'José Pelizer', '3259-3027', 'Piquiri,', '662', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2610, 1, 1, 'José R Pavão', '3259-1290', 'Joaquim Francisco Lopes,', '321', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2611, 1, 1, 'José Rosa', '3259-2345', 'Monteiro Lobato,', '440', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2612, 1, 1, 'José Stork', '3259-1405', 'BR 369, Rod,', 'Km128', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2613, 1, 1, 'José Ventlando', '3259-2331', 'Joaquim Francisco Lopes,', '768', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2614, 1, 1, 'Josefa R Sampaio', '3259-1376', 'Antonio Brandão de Oliveira, av,', '1270', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2615, 1, 1, 'Josefa V Silva', '3259-1341', 'Frei Timóteo, pç,', '121', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2616, 1, 1, 'Josefina A Lombardi', '3259-3283', 'Benjamin Giavarina, av,', '464', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2618, 1, 1, 'Josenir G Correa', '3259-1291', 'Carmela Dutra,', '500 ap702', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2619, 1, 1, 'Josias C Carvalho', '3259-1707', 'Osório Antunes Farias,', '195', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2620, 1, 1, 'Josias E Denone Jr', '3159-0201', 'Pedro II, D,', '358 ap2', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2621, 1, 1, 'Josimar O Pinto', '3159-0251', 'Getúlio Vargas, Pres, av,', '615 ap31', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2622, 1, 1, 'Jota L Meneses', '3259-2156', 'Joaquim Francisco Lopes,', '816', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2623, 1, 1, 'Juçara M Brito', '3259-1602', 'Joaquim Francisco Lopes,', '440', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2624, 1, 1, 'Jucimara R Costa', '3259-1603', 'Pedro II, D,', '247', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2625, 1, 1, 'Judith F Scussel', '3259-2644', 'Pedro de Alcântara, S,', '70', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2626, 1, 1, 'Juliana F Rosa', '3259-3724', 'Antonio Brandão de Oliveira, av,', '816', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2627, 1, 1, 'Júlio F Daniel', '3259-1029', 'Daniel Pucca,', '168', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2628, 1, 1, 'Júlio Nakaie', '3259-2347', 'Getúlio Vargas, Pres, av,', '808', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2629, 1, 1, 'Juracy R Fatel', '3259-1410', 'Norte, Princs,', '217', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2630, 1, 1, 'Juvercino Gomes', '3259-2340', 'Osório Antunes Farias,', '496', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2631, 1, 1, 'Karina A Chagas', '3259-2313', 'Edson Gonçalves Palhano,', '322', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2633, 1, 1, 'Kleber de Marchi', '3259-1985', 'Nicola Pansardi, av,', '191', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2634, 1, 2, 'Kraumor Imobiliária Projeto Consultoria', '3259-1826', 'Getúlio Vargas, Pres, av,', '615 s2', 'Imobiliárias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2635, 1, 2, 'L A S Pavimentação e Obras', '3259-2890*3259-3122', 'Benjamin Giavarina, av,', '181', 'Pavimentação - Equip e Máq', 0, '');
INSERT INTO agendalocal.clientes VALUES (2636, 1, 2, 'Laboratório São Jorge Ltda', '3159-0162', 'Carmela Dutra,', '500', 'Laboratórios de Análises Clínicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2637, 1, 1, 'Laércio C Carvalho', '3259-2968', 'Joaquim Francisco Lopes,', '1027', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2638, 1, 2, 'Laércio Merlim', '3259-1481', 'Joaquim Francisco Lopes,', '868', 'Carpintarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2639, 1, 1, 'Laerson Anacleto', '3259-3902', 'Mábio Gonçalves Palhano,', '35', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2640, 1, 2, 'Laine Variedades', '3259-1719', 'Monteiro Lobato,', '640 lj1', 'Bazares', 0, '');
INSERT INTO agendalocal.clientes VALUES (2641, 1, 2, 'Lanchonete e Sorveteria Q Delícia', '3159-1313', 'Monteiro Lobato,', '701', 'Lanchonetes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2642, 1, 1, 'Laura P Clevelaro', '3259-1388', 'Getúlio Vargas, Pres, av,', '300', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2643, 1, 1, 'Lavínia A P Nichimura', '3259-3262', 'Paul Perci Harris,', '1-B', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2644, 1, 1, 'Leila A Mussi', '3159-0295', 'Joaquim Francisco Lopes,', '573', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2645, 1, 1, 'Leila E Cardoso', '3159-0210', 'Adélia Antunes Lopes, Profª, av,', '114', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2646, 1, 1, 'Leonice B S Vaz', '3259-1001', 'Osório Antunes Farias,', '126', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2647, 1, 1, 'Leonice Rosa', '3259-2159', 'Mábio Gonçalves Palhano,', '254', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2648, 1, 1, 'Leonora M Oliveira', '3259-3390', 'Tânia Lúcia Correia,', '117', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2649, 1, 1, 'Levi S Matos', '3259-2311', 'Norberto Camargo Lemos,', '3', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2650, 1, 1, 'Lorival L Silva', '3259-2510', 'Nicola Pansardi, av,', '410', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2651, 1, 2, 'Lotérica Estrela da Sorte', '3259-2222', 'Carmela Dutra,', '555', 'Casas Lotéricas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2652, 1, 1, 'Lourival O Santos', '3259-3089', 'Antonio Brandão de Oliveira, av,', '980', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2653, 1, 1, 'Lourivaldo A Santos', '3259-1390', 'Carmela Dutra,', '1018 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2654, 1, 1, 'Luan Silva', '3259-1127', 'João Martins Dutra,', '20', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2655, 1, 1, 'Lucas A Silva', '3259-1998', 'Piquiri,', '280', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2656, 1, 1, 'Lucélia C Silva', '3259-2244', 'Konji Kubo,', '102', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2657, 1, 1, 'Lúcia A Lima', '3259-1005', 'Santos Dumont,', '586', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2658, 1, 1, 'Lúcia B Pereira', '3259-3712', 'Mábio Gonçalves Palhano,', '22', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2659, 1, 1, 'Lúcia Baran', '3259-3736', 'Nicola Pansardi, av,', '215', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2660, 1, 1, 'Luciana C Barbosa', '3259-1296', 'Carmela Dutra,', '77', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2682, 1, 1, 'Maria A Abe', '3259-3556', 'Nicola Pansardi, av,', '40', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2697, 1, 1, 'Maria J Gonçalves', '3259-2320', 'Getúlio Vargas, Pres, av,', '615', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2715, 1, 1, 'Maria L Souza', '3259-1782', 'John Fitzgerald Kennedy, Pres,', '612', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2727, 1, 1, 'Marineide V Tarosso', '3259-1631', 'Benjamin Giavarina, av,', '101', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2662, 1, 1, 'Lucimar Souza', '3259-2666', 'Nicola Pansardi, av,', '991', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2663, 1, 1, 'Lucineli S Bissi', '3159-0350', 'Joaquim Francisco Lopes,', '890 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2664, 1, 1, 'Luis C Maldonado', '3259-2155', 'Antonio Brandão de Oliveira, av,', '1217', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2665, 1, 1, 'Luiz A M Budoia', '3259-2271', 'Piquiri,', '62', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2666, 1, 1, 'Luiz C Costelini', '3259-1419', 'Nicola Pansardi, av,', '464', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2667, 1, 1, 'Luiz Despensieri', '3259-2333', 'Nicola Pansardi, av,', '653', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2668, 1, 1, 'Luiz F Pavão', '3159-0111', 'Antonio Brandão de Oliveira, av,', '1509', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2669, 1, 1, 'Luiz Kaminari', '3259-1494', 'Massamo Inohue,', '66', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2670, 1, 1, 'Luiz Polonia', '3259-2275', 'Paraná, av,', '52 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2671, 1, 1, 'Luiz R C Carvalho', '3159-0109', 'Massahiro Inohue,', '109', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2672, 1, 1, 'Madelaine G Bettega', '3259-1141', 'Medardo Galli,', '240', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2673, 1, 1, 'Manoel D Pereira', '3259-1218', 'Carmela Dutra,', '413 ap1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2675, 1, 1, 'Manuel C Souza', '3259-2245', 'Sebastião Lúcio Ferreira,', '157', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2676, 1, 1, 'Marcelo Aguiar', '3259-2199', 'Santo Cardim,', '15', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2677, 1, 1, 'Marcelo E Santana', '3259-1984', 'Minoru Goto,', '69', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2678, 1, 1, 'Marcília G F Antonio', '3259-2961', 'Norberto Camargo Lemos,', '76', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2679, 1, 1, 'Márcio I Pucca', '3259-3054', 'Santo Cardim,', '524', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2680, 1, 1, 'Marcos A Oliveira', '3259-2420', 'Antonio Brandão de Oliveira, av,', '1607', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2681, 1, 1, 'Margareth E Abe', '3259-1307', 'BR 369, Rod,', 'Km130', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2683, 1, 1, 'Maria A Arruda', '3259-2322', 'Osório Antunes Farias,', '546', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2684, 1, 1, 'Maria A Fermino', '3259-1979', 'José Alves,', '178', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2685, 1, 1, 'Maria A M Rysik', '3259-1193', 'BR 369, Rod,', 'Km1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2686, 1, 1, 'Maria A M Silva', '3259-1972', 'Benjamin Giavarina, av,', '236', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2687, 1, 1, 'Maria A Silva', '3259-1891', 'Curitiba,', '74 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2688, 1, 1, 'Maria C C Ferreira', '3259-2737', 'Nicola Pansardi, av,', '30', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2689, 1, 1, 'Maria C O Fidelis', '3259-2312', 'Nicola Pansardi, av,', '631', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2690, 1, 1, 'Maria C S Kyosen', '3159-0355', 'Getúlio Vargas, Pres, av,', '466 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2691, 1, 1, 'Maria D Ribeiro', '3259-2411', 'Carmela Dutra,', '1000', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2692, 1, 1, 'Maria E M Ribeiro', '3159-0311', 'Antonio Pádua Correia,', '102', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2693, 1, 1, 'Maria F Santos', '3159-0031', 'Juraci Nunes do Espírito Santo,', '220', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2694, 1, 1, 'Maria H I Lima', '3259-3221', 'Konji Kubo,', '24', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2695, 1, 1, 'Maria I C Giavarina', '3259-2294', 'Monteiro Lobato,', '666', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2696, 1, 1, 'Maria J Costellini', '3259-1330', 'Antonina, Br, av,', '697', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2698, 1, 1, 'Maria J Justo', '3259-3415', 'Antonio Brandão de Oliveira, av,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2699, 1, 1, 'Maria J Oliveira', '3259-1261', 'Getúlio Vargas, Pres, av,', '492 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2700, 1, 1, 'Maria J Pereira', '3259-2261', 'Pedreira,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2701, 1, 1, 'Maria J R Pereira', '3259-2132', 'Tibagi,', '16', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2702, 1, 1, 'Maria J S Muniz', '3259-1256', 'Tiradentes,', '273', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2704, 1, 1, 'Maria J S Oliveira', '3259-2484', 'José Alves,', '47', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2705, 1, 1, 'Maria J S Pansardi', '3159-2155', 'José Alves,', '83', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2706, 1, 1, 'Maria J Silani', '3259-1464', 'Castelo Branco,', '56', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2707, 1, 1, 'Maria L A Santos', '3259-3254', 'Euzébio Monteiro,', '591', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2708, 1, 1, 'Maria L B Moura', '3259-3687', 'Massahiro Inohue,', '98', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2709, 1, 1, 'Maria L B Rezende', '3259-3846', 'Antonio Brandão de Oliveira, av,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2710, 1, 1, 'Maria L C Balan', '3259-1479', 'João Silva,', '278', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2711, 1, 1, 'Maria L Domingues', '3259-1289', 'Antonio Brandão de Oliveira, av,', '747', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2712, 1, 2, 'Maria L J Bernini', '3259-2430', 'John Fitzgerald Kennedy, Pres,', '612', 'Farmácias e Drogarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2713, 1, 1, 'Maria L M Santos', '3159-0286', 'Norte, Princs,', '183', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2714, 1, 1, 'Maria L R Cardoso', '3259-1693', 'Orlando Salles Striquer, av,', '839', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2716, 1, 1, 'Maria L V Mateus', '3259-1909', 'Esmeralda Vieira Arruda,', '70', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2717, 1, 1, 'Maria M Cândido', '3259-1804', 'Pedro de Alcântara, S,', '161', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2718, 1, 1, 'Maria M S Secco', '3259-1895', 'Pedro de Alcântara, S,', '39', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2719, 1, 1, 'Maria M Silva', '3259-1660', 'Minas Gerais,', '256', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2720, 1, 1, 'Maria P S Moura', '3259-3502', 'Orlando Salles Striquer, av,', '361', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2721, 1, 1, 'Maria R Pansardi', '3259-1367', 'Joaquim Francisco Lopes,', '151', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2722, 1, 1, 'Maria S L Silva', '3259-3737', 'Esmeralda Vieira Arruda,', '51 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2723, 1, 1, 'Maria Z C S Moura', '3259-2325', 'Massamo Inohue,', '138', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2725, 1, 1, 'Marilda A S Santos', '3259-2830', 'Piquiri,', '749', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2726, 1, 1, 'Marina S Almagro', '3259-3777', 'Antonina, Br, av,', '430', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2728, 1, 1, 'Mario I Fukumoto', '3259-1331', 'Pedro II, D,', '195', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2729, 1, 1, 'Mario K Abe', '3259-1525', 'Piquiri,', '661', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2730, 1, 1, 'Marízia P Silva', '3259-1328', 'Antonio Brandão de Oliveira, av,', '951', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2731, 1, 1, 'Marlene P Costa', '3259-2746', 'Piquiri,', '662', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2732, 1, 1, 'Marlene Ribeiro', '3259-1377', 'Antonio Brandão de Oliveira, av,', '879', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2733, 1, 1, 'Marly S Oliveira', '3259-3068', 'Antonio Brandão de Oliveira, av,', '436 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2734, 1, 1, 'Marta G Pereira', '3259-1281', 'Mábio Gonçalves Palhano,', '242', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2735, 1, 1, 'Massatoshi Hoshino', '3259-1364', 'BR 369, Rod,', 'Km122', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2736, 1, 2, 'Mastercar Multimarcas', '98423-5850*99809-9532', 'Paraná, av,', '416', 'Oficinas Mecânicas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2737, 1, 1, 'Matilde F M Dantas', '3259-2192', 'John Fitzgerald Kennedy, Pres,', '764', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2802, 1, 2, 'Panificadora e Confeitaria Central', '3259-2773', 'Carmela Dutra,', '435', 'Padarias e Confeitarias', 1, '');
INSERT INTO agendalocal.clientes VALUES (2739, 1, 1, 'Maurício Bernini Sob', '3259-2252', 'Benjamin Giavarina, av,', '504', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2740, 1, 1, 'Maurício S Barbosa', '3259-2203', 'José Felipe de Azevedo,', '50', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2741, 1, 1, 'Maurício Silva', '3259-1870', 'Donizete Pinto Brandão,', '139', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2742, 1, 1, 'Mauro Andrade', '3259-1646', 'Pedro II, D,', '246', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2743, 1, 1, 'Mauro Contiero', '3259-2197', 'Joaquim Francisco Lopes,', '55', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2744, 1, 1, 'Mauro Demarchi', '3259-1535', 'Nicola Pansardi, av,', '257', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2745, 1, 1, 'Mauro J Pierro Jr', '3159-0279', 'Antonio Brandão de Oliveira, av,', '15', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2746, 1, 1, 'Mauro Rafael', '3259-1694', 'Nicola Pansardi, av,', '643', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2747, 1, 1, 'Maycon D F Galli', '3259-1091', 'Antonina, Br, av,', '667', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2748, 1, 1, 'Meire A R Dalto', '3259-2418', 'Nicola Pansardi, av,', '141', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2749, 1, 2, 'Menezes Gás', '3259-1134', 'Bahia,', '157', 'Gás - Fornecedores', 1, '');
INSERT INTO agendalocal.clientes VALUES (2750, 1, 2, 'Menezes Presentes', '3159-0357', 'Pedro de Alcântara, S,', '110', 'Presentes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2751, 1, 2, 'Mercado Me', '3159-1654', 'Piquiri,', '777', 'Supermercados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2752, 1, 2, 'Mercado Menezes', '3259-1134', 'Bahia,', '157', 'Supermercados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2753, 1, 1, 'Mercedes T Santos', '3259-3751', 'José Felipe de Azevedo,', '112', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2754, 1, 2, 'Metais Perfurados Viginotti', '3159-0007', 'John Fitzgerald Kennedy, Pres,', '195', 'Chapas Metálicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2755, 1, 1, 'Miguel B Silva', '3259-1450', 'Pedro II, D,', '264', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2756, 1, 1, 'Mitiko Nakasono', '3259-1295', 'Carmela Dutra,', '79', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2757, 1, 1, 'Mitsuo Waizuri', '3259-1155', 'Avelino Alves Pereira, tv,', '81', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2758, 1, 1, 'Moacir Moretto', '3259-2234', 'Antonina, Br, av,', '926', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2760, 1, 2, 'Modelo Tapeçaria', '3159-1715', 'Curitiba,', 'lt1', 'Tapeçarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2761, 1, 1, 'Morilio Q Silva', '3259-1239', 'Getúlio Vargas, Pres, av,', '872', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2762, 1, 2, 'Móveis Estrela', '3259-1455', 'Carmela Dutra,', '408 e 416', 'Móveis - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2763, 1, 2, 'Móveis Santo Expedito', '3259-3167*99166-1577', 'Orlando Salles Striquer, av,', '590', 'Móveis - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2764, 1, 2, 'Nadir L N Bianchi', '3259-2179', 'John Fitzgerald Kennedy, Pres,', '629', 'Esteticistas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2765, 1, 1, 'Nair A F S Pereira', '3259-3472', 'Alcides Liziero,', '67', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2766, 1, 1, 'Natal F Cutisque', '3259-1641', 'Osório Antunes Farias,', '146', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2767, 1, 1, 'Nelma A D Ryzik', '3259-1413', 'Caetano Munhoz da Rocha, Pres, av,', '455', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2768, 1, 1, 'Nelson M Souza', '3259-2260', 'Santos Dumont,', '466', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2769, 1, 1, 'Nery Santos', '3259-3553', 'João Silva,', '134', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2770, 1, 1, 'Neuza M Mendes', '3259-1064', 'Joaquim Francisco Lopes,', '440', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2771, 1, 1, 'Neuza M P Cardoso', '3259-2764', 'Orlando Salles Striquer, av,', '39', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2772, 1, 1, 'Nilda A C Ribeiro', '3259-1133', 'Orlando Salles Striquer, av,', '421', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2773, 1, 1, 'Nilton F Santos', '3259-3212', 'Thomaz Antonio Fagá,', '121', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2774, 1, 1, 'Nilza M S Mendes', '3259-2984', 'Nicola Pansardi, av,', '979 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2775, 1, 1, 'Nilzete S Lima', '3259-1811', 'Nicola Pansardi, av,', '50', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2776, 1, 1, 'Nirceu Traguetta', '3259-2352', 'Tânia Lúcia Correia,', '127', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2777, 1, 1, 'Nivais P Pardim', '3322-0430', 'Antonina, Br, av,', '515', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2778, 1, 2, 'Nivaldo G Laurindo', '3259-3748', 'Antonio Brandão de Oliveira, av,', '684', 'Vidraçarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2779, 1, 1, 'Nobuco Suguieda', '3259-1421', 'BR 369, Rod,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2780, 1, 1, 'Nobuo Kosugue', '3259-3853', 'Benjamin Giavarina, av,', '1134', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2781, 1, 1, 'Noel A Lima', '3259-3055', 'Antonina, Br, av,', '800', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2782, 1, 1, 'Norma Contato', '3159-0265', 'Carmela Dutra,', '500 ap502', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2784, 1, 1, 'Odair Perbellini', '3159-0025', 'Deusdedeth Chinotti,', '32', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2785, 1, 1, 'Odemir Marques', '3259-2206', 'Antonio Pádua Correia,', '127', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2786, 1, 1, 'Odete A Bertola', '3259-2402', 'Santo Cardim,', '351', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2787, 1, 2, 'Oficina Opção', '3259-2879', 'Caetano Munhoz da Rocha, Pres, av,', '317', 'Oficinas Mecânicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2788, 1, 2, 'Oficina Trime', '3159-0078*3159-1492', 'BR 369, Rod,', 'Km128', 'Automóveis - Funilaria e Pintura', 0, '');
INSERT INTO agendalocal.clientes VALUES (2789, 1, 1, 'Ondina A Araújo', '3259-1244', 'João Silva,', '539 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2790, 1, 1, 'Onofre H Silva', '3259-1779', 'Domingos Ribeiro,', '54 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2791, 1, 2, 'Operações e Serviços Rodoviários Ltda', '3259-1169', 'Monteiro Lobato,', '188', 'Rodovias - Administração', 0, '');
INSERT INTO agendalocal.clientes VALUES (2792, 1, 1, 'Osicléia D Santos', '3259-2272', 'José Alves,', 'lt1', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2793, 1, 1, 'Osni A Machado', '3259-1966', 'Benjamin Giavarina, av,', '621', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2794, 1, 2, 'Osvaldir S Melo', '3159-0800', 'Benjamin Giavarina, av,', '184', 'Sorveterias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2795, 1, 1, 'Osvaldo F Lima', '3259-1151', 'Antonina, Br, av,', '441', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2796, 1, 1, 'Osvaldo M Figueira', '3159-0308', 'João Silva,', '661 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2797, 1, 2, 'Oswaldo Bittencourt Jr', '3259-1768', 'Nicola Pansardi, av,', '200', 'Cerâmica', 0, '');
INSERT INTO agendalocal.clientes VALUES (2798, 1, 2, 'Otávio M Ribeiro', '3259-3292', 'Benjamin Giavarina, av,', '125', 'Cirurgiões Dentistas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2799, 1, 2, 'Ótica Visolook', '3259-1059', 'Antonio Brandão de Oliveira, av,', '440', 'Óticas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2800, 1, 2, 'Ozório Gonçalves Leite & Cia Ltda', '3259-3871', 'Antonio Brandão de Oliveira, av,', '509', 'Farmácias e Drogarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2801, 1, 2, 'Panificadora Alisha', '3159-0189*3259-1559', 'Carmela Dutra,', '625', 'Padarias e Confeitarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2803, 1, 2, 'Panificadora e Confeitaria Manoá', '98453-3712*98409-1868', 'Juan Soares Veloso,', '215', 'Padarias e Confeitarias', 1, '');
INSERT INTO agendalocal.clientes VALUES (2804, 1, 2, 'Paróquia Nossa Senhora da Conceição', '3259-1406*3259-3520', 'Getúlio Vargas, Pres, av,', '456', 'Igrejas, Templos e Instituições Religiosas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2805, 1, 1, 'Patrícia P S Lacerda', '3159-0071', 'Jandira de Azevedo Bitencourt', '74', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2806, 1, 1, 'Patrícia R Oliveira', '3259-1604', 'Konji Kubo,', '14', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2807, 1, 1, 'Paulo B Oliveira', '3159-0287', 'João Silva,', '682', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2808, 1, 1, 'Pedro Barbieri', '3259-1497', 'Nicola Pansardi, av,', '265', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2818, 1, 2, 'Ponto de Táxi da Rodoviária', '3259-1657', 'Antonio Brandão de Oliveira, av,', 's/n', 'Táxi', 0, '');
INSERT INTO agendalocal.clientes VALUES (2829, 1, 2, 'Raimundo P Chaves', '3259-3682', 'Carmela Dutra,', 's/n', 'Bebidas - Depósitos e Distrib', 0, '');
INSERT INTO agendalocal.clientes VALUES (2830, 1, 2, 'Raimundo P Chaves Jr', '3259-3594', 'John Fitzgerald Kennedy, Pres,', '501', 'Cosméticos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2837, 1, 1, 'Reginaldo Formagio', '3259-1774', 'Carmela Dutra,', '574', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2810, 1, 1, 'Pedro Rodrigues', '3259-1482', 'BR 369, Rod,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2811, 1, 1, 'Percília N Souza', '3259-3168', 'Nicola Pansardi, av,', '548', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2812, 1, 1, 'Pérola Rosa', '3259-1178', 'Benjamin Giavarina, av,', '577', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2813, 1, 2, 'Pic Burguer Lanches', '3259-1617', 'Getúlio Vargas, Pres, av,', '573', 'Lanchonetes', 1, '');
INSERT INTO agendalocal.clientes VALUES (2814, 1, 2, 'Pierro Contabilidade', '3259-1314*3259-1710', 'Frei Timóteo, pç,', '15', 'Contabilidade - Escritórios', 0, '');
INSERT INTO agendalocal.clientes VALUES (2815, 1, 2, 'Pizzaria Domini', '3159-0322*3259-3416', 'Benjamin Giavarina, av,', '164', 'Pizzarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2816, 1, 2, 'Podóloga Alessandra', '3159-0119*99626-0213', 'Joaquim Francisco Lopes,', '1466', 'Podologia', 1, '');
INSERT INTO agendalocal.clientes VALUES (2819, 1, 2, 'Ponto de Táxi José Carlos', '99103-8123*99639-0336', 'Frei Timóteo, pç,', 's/n', 'Táxis', 1, '');
INSERT INTO agendalocal.clientes VALUES (2820, 1, 2, 'Ponto de Táxi nº1 - Roberto Cortez', '3259-1112*98435-0006 / 99115-0439', 'Frei Timóteo, pç,', 's/n', 'Táxis', 1, '');
INSERT INTO agendalocal.clientes VALUES (2821, 1, 2, 'Posto de Saúde', '3259-1351', 'Bahia,', '242', 'Centros e Postos de Saúde', 0, '');
INSERT INTO agendalocal.clientes VALUES (2822, 1, 2, 'Posto de Saúde Municipal de Jataizinho', '3259-3374', 'Monteiro Lobato,', '600', 'Centros e Postos de Saúde', 0, '');
INSERT INTO agendalocal.clientes VALUES (2823, 1, 2, 'Prefeitura Municipal de Jataizinho', '3259-1316*3259-1456', 'Getúlio Vargas, Pres, av,', '494', 'Prefeituras Municipais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2824, 1, 1, 'Priscila C B Amaral', '3159-0200', 'João Silva,', '970', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2825, 1, 2, 'Quatro Estações', '3159-2014', 'Carmela Dutra,', '439', 'Restaurantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2826, 1, 2, 'R V S Advocacia e Contabilidade', '3259-1260*3259-2361', 'João Silva,', '436', 'Advogados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2827, 1, 2, 'Rádio Nova Geração', '3259-1217', 'Getúlio Vargas, Pres, av,', '420', 'Rádio - Emissoras', 0, '');
INSERT INTO agendalocal.clientes VALUES (2828, 1, 1, 'Rafaela C Costelini', '3159-0178', 'Getúlio Vargas, Pres, av,', '615 ap11', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2831, 1, 1, 'Ralph M Jesus', '3259-2498', 'Alcindo R do Prado,', '319', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2832, 1, 2, 'Recanto Água Branca', '3259-1226', 'BR 369, Rod,', 'Km126', 'Restaurantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2833, 1, 2, 'Recanto das Mangueiras', '3159-0011*3259-2447', 'Caetano Munhoz da Rocha, Pres, av,', '1046', 'Eventos - Organização e Promoção', 0, '');
INSERT INTO agendalocal.clientes VALUES (2834, 1, 2, 'Regiany C Santos', '3259-2066', 'Kojiro Shimizu,', '57', 'Transporte Escolar', 0, '');
INSERT INTO agendalocal.clientes VALUES (2835, 1, 1, 'Regina C R Dourado', '3259-3903', 'Santos Dumont,', '490', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2836, 1, 1, 'Reginaldo B Mello', '3259-1451', 'Joaquim Francisco Lopes,', '23', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2838, 1, 1, 'Reinaldo Delfino', '3259-1556', 'Castelo Branco,', '220', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2839, 1, 1, 'Reinaldo Furlan', '3259-3717', 'Joaquim Francisco Lopes,', '595', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2840, 1, 1, 'Reinaldo J Corsino', '3259-1564', 'Monteiro Lobato,', '210', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2841, 1, 1, 'Reinaldo M Rocha', '3259-1279', 'Tibagi,', '677', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2842, 1, 1, 'Reinaldo Susigan', '3259-3083', 'Antonio R G Correia,', '91', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2843, 1, 2, 'Renato C Oliveira', '3259-1335', 'Nicola Pansardi, av,', '599', 'Advogados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2844, 1, 1, 'Renato F Bonfim', '3259-2117', 'Avelino Alves Pereira, tv,', '97', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2845, 1, 2, 'Restaurante Cantinho da Costela', '3259-1117*98411-4250', 'Getúlio Vargas, Pres, av,', '580-A', 'Restaurantes', 1, '');
INSERT INTO agendalocal.clientes VALUES (2846, 1, 2, 'Restaurante Catarina', '3259-1208', 'BR 369, Rod,', 'Km128', 'Restaurantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2847, 1, 2, 'Restaurante Furlan', '3259-2724*3159-0019 / 99933-5907', 'Caetano Munhoz da Rocha, Pres, av,', '467', 'Restaurantes', 1, '');
INSERT INTO agendalocal.clientes VALUES (2848, 1, 2, 'Restaurante O Casarão', '3259-1580', 'Getúlio Vargas, Pres, av,', '614', 'Restaurantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2849, 1, 2, 'Restaurante Yukai', '3259-2861', 'Getúlio Vargas, Pres, av,', '470', 'Restaurantes', 1, '');
INSERT INTO agendalocal.clientes VALUES (2850, 1, 1, 'Ricardo A Corsino', '3159-0222', 'Monteiro Lobato,', '40', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2851, 1, 1, 'Ricardo M Dantas', '3259-3144', 'Antonio Pavão,', '70', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2852, 1, 2, 'Ricatex Construções e Pinturas Ltda', '3259-3209', 'Joaquim Francisco Lopes,', '1262', 'Construtores', 0, '');
INSERT INTO agendalocal.clientes VALUES (2853, 1, 1, 'Rivaldo B Melo', '3259-3801', 'Piquiri,', '413', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2854, 1, 1, 'Roberto Cortez', '3259-1112', 'Tiradentes,', '261', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2855, 1, 1, 'Roberto Fedato', '3259-1006', 'Antonio Brandão de Oliveira, av,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2856, 1, 1, 'Roberto M Tanaka', '3259-1530', 'Avelino Alves Pereira, tv,', '49', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2857, 1, 2, 'Roberto Ribeiro', '3259-1358', 'Curitiba,', '115', 'Churrasqueiras', 0, '');
INSERT INTO agendalocal.clientes VALUES (2858, 1, 1, 'Roberto Susigan', '3259-1783', 'Osório Antunes Farias,', '106', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2859, 1, 1, 'Robson M Santos', '3159-0030', 'Monteiro Lobato,', '517', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2860, 1, 2, 'Rodrigo C S Melo', '3259-1052', 'Antonio Brandão de Oliveira, av,', '770', 'Sorveterias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2861, 1, 2, 'Rogério R Figueira', '3259-2728', 'Monteiro Lobato,', '319', 'Auto Elétricos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2862, 1, 1, 'Ronaldo B Paula', '3259-2574', 'Orlando Salles Striquer, av,', '679', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2863, 1, 1, 'Ronaldo C Souza', '3159-0327', 'Valter Gomes de Faria,', '36', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2864, 1, 1, 'Rosa A Cardoso', '3259-2463', 'Adolfo Ausec,', '51 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2865, 1, 1, 'Rosângela A Silva', '3259-2140', 'Pedro de Alcântara, S,', '48', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2866, 1, 1, 'Roseli A L Lima', '3259-3362', 'Cândida Alves Queirós,', '238', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2867, 1, 1, 'Roseli A Pinto', '3159-0010', 'Carmela Dutra,', '1079', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2868, 1, 1, 'Roseli S Descheve', '3259-2348', 'Joaquim Francisco Lopes,', '680', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2869, 1, 2, 'Rosenilda Bergamini', '3259-1058', 'Curitiba,', '127', 'Esteticistas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2870, 1, 1, 'Rosimar A Pavão', '3259-1165', 'Caetano Bertagnoli,', '36', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2871, 1, 1, 'Rosimary Ferreira', '3259-1743', 'Joaquim Francisco Lopes,', '158', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2872, 1, 1, 'Rosimeire Dauto', '3259-2246', 'Antonina, Br, av,', '974', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2873, 1, 1, 'Rosimeire M Medeiros', '3159-0228', 'Massamo Inohue,', '108', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2874, 1, 1, 'Rubens Vieira', '3259-2367', 'Antonina, Br, av,', '947', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2876, 1, 1, 'Sandoval A Oliveira', '3259-2648', 'Orlando Salles Striquer, av,', '29', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2877, 1, 2, 'Sandra Damasceno Moreira ME', '3259-1288', 'Antonio Brandão de Oliveira, av,', '481', 'Papelarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2885, 1, 1, 'Sebastião Bernardo', '3159-0269', 'Antonio Pádua Correia,', '76', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2896, 1, 2, 'Sicoob - Cooperativa de Crédito', '3159-8000', 'Paulo, S,', '544', 'Cooperativas de Crédito', 0, '');
INSERT INTO agendalocal.clientes VALUES (2948, 1, 1, 'Victor R Ausec', '3159-5050', 'Getúlio Vargas, Pres, av,', '645', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2879, 1, 2, 'Sandra R D Rodrigues', '3259-2811', 'Piquiri,', '341', 'Radiadores', 0, '');
INSERT INTO agendalocal.clientes VALUES (2880, 1, 1, 'Sandra S C Picoli', '3259-1902', 'Mábio Gonçalves Palhano,', '326', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2881, 1, 1, 'Sandro J Fidelis', '3259-3020', 'Massahiro Inohue,', '196', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2883, 1, 1, 'Saturnino S Domingues', '3259-1206', 'Joaquim Francisco Lopes,', '161', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2884, 1, 1, 'Sebastiana C Medeiros', '3259-1921', 'José Felipe de Azevedo,', '51 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2886, 1, 1, 'Sebastião C Schiavon', '3259-2279', 'Nicola Pansardi, av,', '430', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2887, 1, 1, 'Sebastião E Contato', '3259-1232', 'Nicola Pansardi, av,', '153', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2888, 1, 1, 'Sebastião M Soares', '3259-2237', 'Santos Dumont,', '568 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2889, 1, 1, 'Sebastião Oliveira', '3259-2143', 'Tânia Lúcia Correia,', '33', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2890, 1, 2, 'Seminário São José', '3259-1653', 'Antonina, Br, av,', '548', 'Seminários', 0, '');
INSERT INTO agendalocal.clientes VALUES (2891, 1, 1, 'Sérgio D Cano', '3259-2300', 'Norberto Camargo Lemos,', '5', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2892, 1, 1, 'Sérgio P Cezar', '3159-0235', 'João Silva,', '884', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2893, 1, 2, 'Serviço Autônomo de Água e Esgoto SAAE', '3259-1172', 'Piquiri,', '500', 'Água e Esgotos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2894, 1, 2, 'Serviço Distrital de Jataizinho', '3259-1730', 'Antonio Brandão de Oliveira, av,', '336', 'Cartórios e Tabeliães', 0, '');
INSERT INTO agendalocal.clientes VALUES (2895, 1, 1, 'Shirley J Fernandes', '3259-2406', 'Benjamin Giavarina, av,', '876', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2897, 1, 1, 'Sidnei A Santos', '3259-1912', 'Joaquim Francisco Lopes,', '1356', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2898, 1, 1, 'Sildete B Jose', '3259-2145', 'Pedro de Alcântara, S,', '245', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2899, 1, 1, 'Silvana B Santos', '3159-0407', 'Curitiba,', '337', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2900, 1, 1, 'Silvano B Ledo', '3259-1442', 'BR 369, Rod,', 'Km131', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2901, 1, 1, 'Silvia A Silva', '3259-3076', 'Vitorina Zanini Ribeiro,', '344', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2902, 1, 1, 'Silvio A Oliveira', '3259-2359', 'Avelino Alves Pereira, tv,', '73', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2903, 1, 1, 'Simone C Vieira', '3259-2916', 'Orlando Salles Striquer, av,', '331', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2904, 1, 2, 'Sindicato Rural de Jataizinho', '3259-1439', 'Carmela Dutra,', '570', 'Sindicatos e Federações', 0, '');
INSERT INTO agendalocal.clientes VALUES (2906, 1, 2, 'Sindicato Trabalhadores Ind Construção Mobiliário Jataizinho', '3259-2332', 'João Silva,', '555', 'Sindicatos e Federações', 0, '');
INSERT INTO agendalocal.clientes VALUES (2907, 1, 2, 'Sintiajet', '3159-0382', 'John Fitzgerald Kennedy, Pres,', '660', 'Sindicatos e Federações', 0, '');
INSERT INTO agendalocal.clientes VALUES (2908, 1, 1, 'Solange Bergamini', '3259-1699', 'Santo Cardim,', '26', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2909, 1, 2, 'Sonia Bergamini', '3259-1145', 'João Silva,', '339', 'Magazines', 0, '');
INSERT INTO agendalocal.clientes VALUES (2910, 1, 1, 'Sonia Cruz', '3259-2249', 'Carmela Dutra,', '1005', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2911, 1, 2, 'Suely A M Chamilete', '3259-1362', 'Frei Timóteo, pç,', '43', 'Advogados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2912, 1, 2, 'Suely Advocacia', '3259-3901', 'Antonina, Br, av,', '391 fds', 'Advogados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2913, 1, 1, 'Suely Leite', '3259-2669', 'Norte, Princs,', '50', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2914, 1, 2, 'Supermercado Super Ausec', '3159-0216*3259-2193 / 3259-2581', 'Nicola Pansardi, av,', '477', 'Supermercados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2915, 1, 2, 'Supermercado Super Sul', '3159-0044', 'Antonio Brandão de Oliveira, av,', '406', 'Supermercados', 1, '');
INSERT INTO agendalocal.clientes VALUES (2916, 1, 2, 'Supermercados Baza Ltda', '3159-0044', 'Antonio Brandão de Oliveira, av,', '406', 'Supermercados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2917, 1, 1, 'Suzana A Moreira', '3259-1002', 'Konji Kubo,', '79', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2918, 1, 1, 'Tadashi Hoshino', '3259-1160', 'BR 369, Rod,', 's/n', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2919, 1, 2, 'Tampinha Gás', '3259-3270*98459-8640', 'José de Oliveira Lima,', '194', 'Gás - Fornecedores', 1, '');
INSERT INTO agendalocal.clientes VALUES (2920, 1, 1, 'Tânia M P Ouro', '3259-3363', 'Getúlio Vargas, Pres, av,', '696', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2921, 1, 2, 'Tapeçaria Modelo', '3259-1715', 'Curitiba,', '7', 'Tapeçarias', 0, '');
INSERT INTO agendalocal.clientes VALUES (2922, 1, 2, 'Tathy Modas', '3159-0289', 'Benjamin Giavarina, av,', '218', 'Roupas Femininas - Lojas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2923, 1, 2, 'Táxi Jataizinho', '3259-1266', 'Frei Timóteo, pç,', 's/n', 'Táxi', 0, '');
INSERT INTO agendalocal.clientes VALUES (2924, 1, 1, 'Tereza R Reichel', '3259-3460', 'Benjamin Giavarina, av,', '766', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2925, 1, 1, 'Terezinha A G Liz', '3259-1142', 'Carmela Dutra,', '211', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2926, 1, 1, 'Terezinha F Terra', '3259-1046', 'Getúlio Vargas, Pres, av,', '580', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2927, 1, 1, 'Thaís F Barboza', '3159-1222', 'Antonio Pádua Correia,', '50', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2928, 1, 1, 'Tiago A Santos', '3159-0381', 'João Silva,', '485', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2929, 1, 1, 'Tiago J Castro', '3259-1122', 'Antonio Brandão de Oliveira, av,', '598', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2930, 1, 1, 'Toyoko Kawata', '3259-3447', 'John Fitzgerald Kennedy, Pres,', '531', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2931, 1, 1, 'Tsuneo Kimura', '3259-1363', 'BR 369, Rod,', 'Km123', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2932, 1, 1, 'Valdeci A Luz', '3159-0271', 'Edson David Palhano,', '44 c3', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2933, 1, 1, 'Valdeci L Santos', '3259-1673', 'Maranhão,', '320', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2934, 1, 2, 'Valdecir A Sampaio', '3259-3086', 'João Silva,', '164', 'Barbantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2935, 1, 1, 'Valdeir N Silva', '3259-2368', 'Minas Gerais,', '219', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2936, 1, 1, 'Valdir Crinceva', '3259-1073', 'José Moraes Neves,', '29', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2937, 1, 1, 'Valdite M Ribeiro', '3259-3716', 'Oswaldo Zanini,', '56', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2938, 1, 1, 'Valério R Zanini', '3259-1558', 'Joaquim Francisco Lopes,', '22', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2939, 1, 1, 'Valter Moreira', '3259-2307', 'Joaquim Francisco Lopes,', '46', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2940, 1, 1, 'Vanderléia F Silva', '3259-2934', 'Guanabara,', '166 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2941, 1, 1, 'Vanderléia S C Cezar', '3259-3225', 'Domingos Ribeiro,', '34', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2942, 1, 1, 'Vanderley M Baptista', '3159-0154', 'Edson David Palhano,', '55', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2943, 1, 1, 'Vania A Silva', '3159-0182', 'Caetano Munhoz da Rocha, Pres, av,', '260', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2944, 1, 1, 'Vera L S Gregui', '3259-1569', 'João Silva,', '338', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2945, 1, 1, 'Verônica E Silvestre', '3259-1258', 'Massamo Inohue,', '107', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2946, 1, 2, 'Viação Garcia', '3259-1460', 'Antonio Brandão de Oliveira, av,', 's/n', 'Transporte Interurbano e Interestadual', 0, '');
INSERT INTO agendalocal.clientes VALUES (2947, 1, 1, 'Vicentina M Souza', '3259-1896', 'Carmela Dutra,', '979', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2949, 1, 2, 'Vilela Vilela & Cia Ltda', '3159-7000', 'PR 323, Rod,', 'Km31', 'Agricultura e Pecuária - Pesquisas e Projetos', 0, '');
INSERT INTO agendalocal.clientes VALUES (2233, 1, 1, 'Abel L Meneses Teste', '3259-1276', 'Pedro de Alcântara, S,los muchachos', '110 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2256, 1, 2, 'Alimentos Chef Ouro', '3159-3434', 'Caetano Munhoz da Rocha, Pres, av,', '950', 'Alimentos Prontos - Entregas a Domicílio', 0, '');
INSERT INTO agendalocal.clientes VALUES (2296, 1, 2, 'Antonio R. V. P. de Godoy & Cia Ltda', '3259-1372', 'Caetano Munhoz da Rocha, Pres, av,', 's/n', 'Postos de Combustíveis e Serviços', 0, '');
INSERT INTO agendalocal.clientes VALUES (2305, 1, 1, 'Aparecida M Maciel', '3259-3267', 'Antonio Moreno Eggéia,', '109', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2314, 1, 2, 'Auto Center Suprema', '3259-1459*3259-2906 / 98403-2962', 'Carmela Dutra,', '836', 'Automóveis - Peças, Lojas e Serviços', 1, '');
INSERT INTO agendalocal.clientes VALUES (2355, 1, 2, 'Central Escapamentos e Auto Elétrica', '3159-3430*3259-3430', 'Antonina, Br, av,', '300', 'Pneus', 1, '');
INSERT INTO agendalocal.clientes VALUES (2372, 1, 1, 'Cláudio A Lima', '3259-1182', 'Osório Antunes Farias,', '26', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2373, 1, 2, 'Cláudio Lopes Comércio e Serviços Automotores', '3159-0194', 'Caetano Munhoz da Rocha, Pres, av,', '701', 'Oficinas Mecânicas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2426, 1, 2, 'Domene Agropecuária', '3159-3000', 'Antonio Brandão de Oliveira, av,', '270', 'Fertilizantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2441, 1, 1, 'Edite M Cordeiro', '3259-2831', 'Rio Grande do Sul,', '367', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2451, 1, 2, 'Eliedison Silva', '3259-3318', 'Antonio Brandão de Oliveira, av,', '832', 'Chaveiros', 0, '');
INSERT INTO agendalocal.clientes VALUES (2483, 1, 1, 'Fábio L Souza', '3159-0282', 'Norberto Camargo Lemos,', '50', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2504, 1, 2, 'Funerária Jataizinho El Kadri', '3259-1257*99112-1257 / 99103-0943', 'Antonio Brandão de Oliveira, av,', '1227', 'Funerárias', 1, '');
INSERT INTO agendalocal.clientes VALUES (2511, 1, 1, 'Gersina M V N Moura', '3259-2891', 'Santo Cardim,', '401', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2518, 1, 2, 'Gomes e Furquim Ltda- ME', '3259-1183', 'Antonina, Br, av,', '320', 'Automóveis - Acessórios', 0, '');
INSERT INTO agendalocal.clientes VALUES (2557, 1, 1, 'Irene G Barreto', '3159-0351', 'Antonio Brandão de Oliveira, av,', '570 fds', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2586, 1, 1, 'Joel Antunes', '3259-1310', 'Antonio R G Correia,', '5', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2601, 1, 2, 'José F Santos', '3259-1326', 'Pedro II, D,', '229', 'Gás - Fornecedores', 0, '');
INSERT INTO agendalocal.clientes VALUES (2632, 1, 2, 'Kazz Moto Peças', '3259-1589', 'Carmela Dutra,', '630', 'Motocicletas - Conserto e Peças', 0, '');
INSERT INTO agendalocal.clientes VALUES (2661, 1, 1, 'Lucibel P Silva', '3259-2001', 'Benjamin Giavarina, av,', '839', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2674, 1, 1, 'Manoel Quitério', '3259-1099', 'Joaquim Francisco Lopes,', '1015', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2703, 1, 1, 'Maria J S Ohashi', '3259-1327', 'Benjamin Giavarina, av,', '276', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2724, 1, 2, 'Marielle Mailan', '3259-1496', 'Antonio Brandão de Oliveira, av,', '424', 'Roupas Femininas - Lojas', 0, '');
INSERT INTO agendalocal.clientes VALUES (2738, 1, 1, 'Maurício A Terra', '3259-2254', 'Benjamin Giavarina, av,', '1180', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2759, 1, 2, 'Modas Rio', '3259-1496', 'Antonio Brandão de Oliveira, av,', '424', 'Roupas Femininas - Lojas', 1, '');
INSERT INTO agendalocal.clientes VALUES (2783, 1, 2, 'NS Link Provedor de Acesso a Internet Ltda', '3324-0010', 'Carmela Dutra,', '500 s2', 'Informática - Internet - Serviços On-Line', 0, '');
INSERT INTO agendalocal.clientes VALUES (2809, 1, 1, 'Pedro G Silva', '3259-3496', 'Carmela Dutra,', '500 ap602', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2817, 1, 2, 'Polícia Militar de Jataizinho', '3259-3123', 'Benjamin Giavarina, av,', '441', 'Delegacias e Distritos Policiais', 0, '');
INSERT INTO agendalocal.clientes VALUES (2875, 1, 2, 'Sacolão Boa Esperança', '3159-4000', 'Antonina, Br, av,', '457', 'Sacolão Hortifrutigranjeiros', 0, '');
INSERT INTO agendalocal.clientes VALUES (2878, 1, 1, 'Sandra M Espadini', '3159-0277', 'Antonio Brandão de Oliveira, av,', '598 sl', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2882, 1, 2, 'Sandro M S Sampaio', '3259-1680', 'Antonio Brandão de Oliveira, av,', '1248 fds', 'Supermercados', 0, '');
INSERT INTO agendalocal.clientes VALUES (2905, 1, 2, 'Sindicato Servidores Públicos Municipais Jataizinho', '3159-1000', 'Antonio Brandão de Oliveira, av,', '598 s4', 'Sindicatos e Federações', 0, '');
INSERT INTO agendalocal.clientes VALUES (2950, 1, 2, 'Villa Pet', '3259-2895*3159-0370 / 99187-1038', 'Getúlio Vargas, Pres, av,', '580', 'Pet Shop', 1, '');
INSERT INTO agendalocal.clientes VALUES (2951, 1, 1, 'Vilma Souza', '3259-2154', 'Antonio Pádua Correia,', '105', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2952, 1, 1, 'Vilson V Borelli', '3327-3968', 'Antonina, Br, av,', '705', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2953, 1, 1, 'Vinícius Bittencourt', '3259-3847', 'Paraná, av,', '129', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2954, 1, 1, 'Vitor A Ribeiro', '3159-0079', 'Getúlio Vargas, Pres, av,', '615 ap13', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2955, 1, 1, 'Vivian M Pereira', '3159-0050', 'Antonio Brandão de Oliveira, av,', '549', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2956, 1, 1, 'Viviane Tini', '3259-2727', 'João Silva,', '145 ap4', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2957, 1, 1, 'Waldecir Silva', '3259-2609', 'Norte, Princs,', '401', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2958, 1, 1, 'Waldemar S Onça', '3259-1521', 'Massahiro Inohue,', '133', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2959, 1, 1, 'Waldomiro Facio', '3259-1592', 'Carmela Dutra,', '735', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2960, 1, 1, 'Waldomiro M Santos', '3259-1578', 'Joaquim Francisco Lopes,', '776', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2961, 1, 1, 'Walmir Tini', '3259-1285', 'Carmela Dutra,', '500 ap301', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2962, 1, 1, 'Walter A Fidelis', '3259-1798', 'Castelo Branco,', '275', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2963, 1, 1, 'Wanderlei Perbellini', '3159-0267', 'Piquiri,', '21', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2964, 1, 1, 'Wanderley L Pereira', '3259-1299', 'Maranhão,', '414', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2965, 1, 1, 'Wanderley Santos', '3259-1591', 'Carmela Dutra,', '989', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2966, 1, 1, 'Wanilda S F Silva', '3259-2623', 'Aristides Bitencourt,', '419', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2967, 1, 1, 'Wilmar Menengolo', '3259-2978', 'Orlando Salles Striquer, av,', '1203', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2968, 1, 1, 'Wilson Eduardo', '3159-2133', 'Benjamin Giavarina, av,', '947', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2969, 1, 2, 'Wilson Silva', '3259-1117', 'Getúlio Vargas, Pres, av,', '580-A', 'Restaurantes', 0, '');
INSERT INTO agendalocal.clientes VALUES (2970, 1, 2, 'WS Rodrigues', '3159-2356', 'Adélia Antunes Lopes, Profª, av,', '310', 'Automóveis - Acessórios', 0, '');
INSERT INTO agendalocal.clientes VALUES (2971, 1, 1, 'Yolanda J Guerra', '3259-3591', 'Vitorina Zanini Ribeiro,', '75 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2972, 1, 1, 'Zilda M Bueno', '3259-3441', 'Benjamin Giavarina, av,', '610', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2973, 1, 1, 'Zoraide R Silva', '3259-1806', 'Juan Soares Veloso,', '226', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2974, 1, 1, 'Zorilda A Santos', '3259-3844', 'João Silva,', '318 c1A', '', 0, '');
INSERT INTO agendalocal.clientes VALUES (2975, 1, 2, 'Zuazen Magazine', '3259-1612*3259-3240', 'Antonio Brandão de Oliveira, av,', '460', 'Magazines', 0, '');
INSERT INTO agendalocal.clientes VALUES (2976, 1, 1, 'Massaroca', '87987', 'jhbjhb', 'bhjbjh', 'bjhbjbjhb', 1, NULL);


--
-- Data for Name: estados; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.estados VALUES (1, 'Acre', 'AC');
INSERT INTO agendalocal.estados VALUES (2, 'Alagoas', 'AL');
INSERT INTO agendalocal.estados VALUES (3, 'Amapá', 'AP');
INSERT INTO agendalocal.estados VALUES (4, 'Amazonas', 'AM');
INSERT INTO agendalocal.estados VALUES (5, 'Bahia', 'BA');
INSERT INTO agendalocal.estados VALUES (6, 'Ceará', 'CE');
INSERT INTO agendalocal.estados VALUES (7, 'Distrito Federal', 'DF');
INSERT INTO agendalocal.estados VALUES (8, 'Espírito Santo', 'ES');
INSERT INTO agendalocal.estados VALUES (9, 'Goiás', 'GO');
INSERT INTO agendalocal.estados VALUES (10, 'Maranhão', 'MA');
INSERT INTO agendalocal.estados VALUES (11, 'Mato Grosso', 'MT');
INSERT INTO agendalocal.estados VALUES (12, 'Mato Grosso do Sul', 'MS');
INSERT INTO agendalocal.estados VALUES (13, 'Minas Gerais', 'MG');
INSERT INTO agendalocal.estados VALUES (14, 'Pará', 'PA');
INSERT INTO agendalocal.estados VALUES (15, 'Paraíba', 'PB');
INSERT INTO agendalocal.estados VALUES (16, 'Paraná', 'PR');
INSERT INTO agendalocal.estados VALUES (17, 'Pernambuco', 'PE');
INSERT INTO agendalocal.estados VALUES (18, 'Piauí', 'PI');
INSERT INTO agendalocal.estados VALUES (19, 'Rio de Janeiro', 'RJ');
INSERT INTO agendalocal.estados VALUES (20, 'Rio Grande do Norte', 'RN');
INSERT INTO agendalocal.estados VALUES (21, 'Rio Grande do Sul', 'RS');
INSERT INTO agendalocal.estados VALUES (22, 'Rondônia', 'RO');
INSERT INTO agendalocal.estados VALUES (23, 'Roraima', 'RR');
INSERT INTO agendalocal.estados VALUES (24, 'Santa Catarina', 'SC');
INSERT INTO agendalocal.estados VALUES (25, 'São Paulo', 'SP');
INSERT INTO agendalocal.estados VALUES (26, 'Sergipe', 'SE');
INSERT INTO agendalocal.estados VALUES (27, 'Tocantins', 'TO');


--
-- Data for Name: inscricoes; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.inscricoes VALUES ('Philipe Massari', 'telefone', 'cep', 'end', 'cpf', 'logo', 'plan', 'email', 'senha', 'atividade', 'Pago', '25/03/2019', 1);
INSERT INTO agendalocal.inscricoes VALUES ('wefwfw', '123213w', 'efwefwfe', '234234', '2', '', '', 'Pendente', '01-04-2019 11:31:06', NULL, NULL, NULL, 2);
INSERT INTO agendalocal.inscricoes VALUES ('Philipe Massari2', 'telefone', 'cep', 'end', 'cpf', 'logo', 'plan', 'email', 'senha', 'atividade', 'Pago', '25/03/2019', 3);
INSERT INTO agendalocal.inscricoes VALUES ('Babakashi', '33472949', '', 'Rikio Nnanaishi', '4245435', '', '2', '', '', '', 'Pendente', '01-04-2019 11:55:44', 4);
INSERT INTO agendalocal.inscricoes VALUES ('Babakashi', '33472949', '', 'Rikio Nnanaishi', '4245435', '', '2', '', '202cb962ac59075b964b07152d234b70', '', 'Pendente', '01-04-2019 11:56:50', 5);
INSERT INTO agendalocal.inscricoes VALUES ('oijj', 'oijoij', '', 'oijoijioj', '3424234', '', '2', '', '202cb962ac59075b964b07152d234b70', '', 'Pendente', '01-04-2019 11:58:58', 6);
INSERT INTO agendalocal.inscricoes VALUES ('iojiojio', '09808098', '', 'joijoijoij', '0980808', '', '2', '', '202cb962ac59075b964b07152d234b70', '', 'Pendente', '01-04-2019 12:24:36', 7);
INSERT INTO agendalocal.inscricoes VALUES ('dwfwefe', 'fwefwf', '', 'ewfew', '32423434', '', '2', '', '202cb962ac59075b964b07152d234b70', '', 'Pendente', '01-04-2019 12:29:37', 8);
INSERT INTO agendalocal.inscricoes VALUES ('wfew', 'wfwfwefw', '', 'fwefwef', 'fefwf', '', '2', '', '202cb962ac59075b964b07152d234b70', '', 'Pendente', '01-04-2019 12:30:24', 9);
INSERT INTO agendalocal.inscricoes VALUES ('wfeew', 'efwfew', '', 'fefwef', '1', '', '2', '', 'c4ca4238a0b923820dcc509a6f75849b', '', 'Pendente', '01-04-2019 12:31:17', 10);


--
-- Data for Name: niveis_acesso; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.niveis_acesso VALUES (1, 'Administrador');
INSERT INTO agendalocal.niveis_acesso VALUES (2, 'Financeiro');
INSERT INTO agendalocal.niveis_acesso VALUES (3, 'Marketing');


--
-- Data for Name: planos; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.planos VALUES (1, '<!-- INICIO FORMULARIO BOTAO PAGSEGURO: NAO EDITE OS COMANDOS DAS LINHAS ABAIXO --> <form action="https://pagseguro.uol.com.br/pre-approvals/request.html" method="post"> <input type="hidden" name="code" value="73BF59846D6D6B7334AFDFB55FBA66D1" /> <input type="hidden" name="iot" value="button" /> <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/assinaturas/209x48-assinar-assina.gif" name="submit" alt="Pague com PagSeguro - É rápido, grátis e seguro!" width="209" height="48" /> </form> <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->', '<!-- INICIO FORMULARIO BOTAO PAGSEGURO: NAO EDITE OS COMANDOS DAS LINHAS ABAIXO --> <form action="https://pagseguro.uol.com.br/pre-approvals/request.html" method="post"> <input type="hidden" name="code" value="013651849E9E8FE7746E7F9CCF9FC613" /> <input type="hidden" name="iot" value="button" /> <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/assinaturas/209x48-assinar-assina.gif" name="submit" alt="Pague com PagSeguro - É rápido, grátis e seguro!" width="209" height="48" /> </form> <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->', '10,00', '20,00');


--
-- Data for Name: tipos_registro; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.tipos_registro VALUES (1, 'Residencial');
INSERT INTO agendalocal.tipos_registro VALUES (2, 'Comercial');


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: agendalocal; Owner: postgres
--

INSERT INTO agendalocal.usuarios VALUES (1, 1, 'João Lucas', 'Benvenho', 'joao.admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3');


--
-- Name: anuncios_id_anuncio_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.anuncios_id_anuncio_seq', 1, false);


--
-- Name: cidades_id_cidade_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.cidades_id_cidade_seq', 1, true);


--
-- Name: clientes_id_cliente_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.clientes_id_cliente_seq', 2976, true);


--
-- Name: estados_id_estado_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.estados_id_estado_seq', 27, true);


--
-- Name: inscricoes_id_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.inscricoes_id_seq', 10, true);


--
-- Name: niveis_acesso_id_nivelacesso_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.niveis_acesso_id_nivelacesso_seq', 3, true);


--
-- Name: tipos_registro_id_tiporegistro_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.tipos_registro_id_tiporegistro_seq', 2, true);


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: agendalocal; Owner: postgres
--

SELECT pg_catalog.setval('agendalocal.usuarios_id_usuario_seq', 2, true);


--
-- Name: anuncios anuncios_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.anuncios
    ADD CONSTRAINT anuncios_pkey PRIMARY KEY (id_anuncio);


--
-- Name: cidades cidades_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.cidades
    ADD CONSTRAINT cidades_pkey PRIMARY KEY (id_cidade);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id_cliente);


--
-- Name: estados estados_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);


--
-- Name: niveis_acesso niveis_acesso_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.niveis_acesso
    ADD CONSTRAINT niveis_acesso_pkey PRIMARY KEY (id_nivelacesso);


--
-- Name: planos planos_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.planos
    ADD CONSTRAINT planos_pkey PRIMARY KEY (id);


--
-- Name: tipos_registro tipos_registro_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.tipos_registro
    ADD CONSTRAINT tipos_registro_pkey PRIMARY KEY (id_tiporegistro);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: anuncios anuncios_id_cidade_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.anuncios
    ADD CONSTRAINT anuncios_id_cidade_fkey FOREIGN KEY (id_cidade) REFERENCES agendalocal.cidades(id_cidade);


--
-- Name: cidades cidades_id_estado_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.cidades
    ADD CONSTRAINT cidades_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES agendalocal.estados(id_estado);


--
-- Name: clientes clientes_id_cidade_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes
    ADD CONSTRAINT clientes_id_cidade_fkey FOREIGN KEY (id_cidade) REFERENCES agendalocal.cidades(id_cidade);


--
-- Name: clientes clientes_id_tiporegistro_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes
    ADD CONSTRAINT clientes_id_tiporegistro_fkey FOREIGN KEY (id_tiporegistro) REFERENCES agendalocal.tipos_registro(id_tiporegistro);


--
-- Name: usuarios usuarios_id_nivelacesso_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.usuarios
    ADD CONSTRAINT usuarios_id_nivelacesso_fkey FOREIGN KEY (id_nivelacesso) REFERENCES agendalocal.niveis_acesso(id_nivelacesso);


--
-- PostgreSQL database dump complete
--

