-- Installing database
 
-- UP

--
-- Name: access_groups; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE access_groups (
    id integer NOT NULL,
    mask integer,
    description character varying
);


ALTER TABLE public.access_groups OWNER TO postgres;

--
-- Name: access_levels_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE access_levels_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.access_levels_id_seq OWNER TO postgres;

--
-- Name: access_levels_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE access_levels_id_seq OWNED BY access_groups.id;


--
-- Name: access_levels_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('access_levels_id_seq', 2, true);


--
-- Name: access_rules; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE access_rules (
    id integer NOT NULL,
    page character varying,
    access_level integer,
    user_id integer,
    estimation integer,
    rules character varying
);


ALTER TABLE public.access_rules OWNER TO postgres;

--
-- Name: access_rules_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE access_rules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.access_rules_id_seq OWNER TO postgres;

--
-- Name: access_rules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE access_rules_id_seq OWNED BY access_rules.id;


--
-- Name: access_rules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('access_rules_id_seq', 7, true);


--
-- Name: buyer; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE buyer (
    id integer NOT NULL,
    email character varying,
    password character varying,
    username character varying,
    last_login integer,
    region_id integer,
    settings character varying[],
    trust_rating double precision
);


ALTER TABLE public.buyer OWNER TO postgres;

--
-- Name: buyer_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE buyer_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.buyer_id_seq OWNER TO postgres;

--
-- Name: buyer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE buyer_id_seq OWNED BY buyer.id;


--
-- Name: buyer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('buyer_id_seq', 1, true);


--
-- Name: category; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE category (
    id integer NOT NULL,
    name character varying,
    parent_id integer,
    is_final boolean,
    type character varying
);


ALTER TABLE public.category OWNER TO postgres;

--
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.category_id_seq OWNER TO postgres;

--
-- Name: category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE category_id_seq OWNED BY category.id;


--
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('category_id_seq', 2, true);


--
-- Name: property; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE property (
    id integer NOT NULL,
    name character varying NOT NULL,
    category_id integer NOT NULL,
    measurement_type_id integer,
    importance double precision
);


ALTER TABLE public.property OWNER TO postgres;

--
-- Name: properties_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE properties_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.properties_category_id_seq OWNER TO postgres;

--
-- Name: properties_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE properties_category_id_seq OWNED BY property.category_id;


--
-- Name: properties_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('properties_category_id_seq', 1, false);


--
-- Name: properties_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE properties_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.properties_id_seq OWNER TO postgres;

--
-- Name: properties_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE properties_id_seq OWNED BY property.id;


--
-- Name: properties_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('properties_id_seq', 4, true);


--
-- Name: properties_importance_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE properties_importance_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.properties_importance_seq OWNER TO postgres;

--
-- Name: properties_importance_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE properties_importance_seq OWNED BY property.importance;


--
-- Name: properties_importance_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('properties_importance_seq', 1, false);


--
-- Name: properties_measurement_type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE properties_measurement_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.properties_measurement_type_id_seq OWNER TO postgres;

--
-- Name: properties_measurement_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE properties_measurement_type_id_seq OWNED BY property.measurement_type_id;


--
-- Name: properties_measurement_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('properties_measurement_type_id_seq', 1, false);


--
-- Name: properties_name_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE properties_name_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.properties_name_seq OWNER TO postgres;

--
-- Name: properties_name_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE properties_name_seq OWNED BY property.name;


--
-- Name: properties_name_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('properties_name_seq', 1, false);


--
-- Name: properties_stores; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE properties_stores (
    property_id integer,
    store_id integer,
    value character varying,
    measurement_unit_id integer,
    value_numeric double precision,
    reliability_rating double precision
);


ALTER TABLE public.properties_stores OWNER TO postgres;

--
-- Name: searchtest_table; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE searchtest_table (
    id integer,
    address character varying,
    name character varying
);


ALTER TABLE public.searchtest_table OWNER TO postgres;

--
-- Name: searchtest_table_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE searchtest_table_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.searchtest_table_id_seq OWNER TO postgres;

--
-- Name: searchtest_table_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE searchtest_table_id_seq OWNED BY searchtest_table.id;


--
-- Name: searchtest_table_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('searchtest_table_id_seq', 1, true);


--
-- Name: store; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE store (
    id integer NOT NULL,
    category_id integer,
    chain_id integer,
    name character varying,
    region_id integer,
    address character varying,
    latitude double precision,
    longitude double precision,
    schedule character varying,
    current_rating double precision,
    reliabiliti_data character varying[],
    contacts character varying
);


ALTER TABLE public.store OWNER TO postgres;

--
-- Name: store_chains; Type: TABLE; Schema: public; Owner: postgres; Tablespace:
--

CREATE TABLE store_chains (
    id integer NOT NULL,
    name character varying,
    data character varying[]
);


ALTER TABLE public.store_chains OWNER TO postgres;

--
-- Name: store_chains_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE store_chains_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.store_chains_id_seq OWNER TO postgres;

--
-- Name: store_chains_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE store_chains_id_seq OWNED BY store_chains.id;


--
-- Name: store_chains_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('store_chains_id_seq', 4, true);


--
-- Name: store_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE store_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.store_id_seq OWNER TO postgres;

--
-- Name: store_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE store_id_seq OWNED BY store.id;


--
-- Name: store_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('store_id_seq', 10, true);


--
-- Name: store_latitude_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE store_latitude_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.store_latitude_seq OWNER TO postgres;

--
-- Name: store_latitude_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE store_latitude_seq OWNED BY store.latitude;


--
-- Name: store_latitude_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('store_latitude_seq', 1, false);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY access_groups ALTER COLUMN id SET DEFAULT nextval('access_levels_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY access_rules ALTER COLUMN id SET DEFAULT nextval('access_rules_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY buyer ALTER COLUMN id SET DEFAULT nextval('buyer_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY category ALTER COLUMN id SET DEFAULT nextval('category_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY property ALTER COLUMN id SET DEFAULT nextval('properties_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY store ALTER COLUMN id SET DEFAULT nextval('store_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY store_chains ALTER COLUMN id SET DEFAULT nextval('store_chains_id_seq'::regclass);


--
-- Data for Name: access_groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO access_groups VALUES (1, 2, 'unlogged');
INSERT INTO access_groups VALUES (2, 4, 'buyer');


--
-- Data for Name: access_rules; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: buyer; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO buyer VALUES (1, 'whisper132@mail.ru', 'VtMoWM1V0u36UZXYAQi6aZ5747lGe/EEpOs=', 'NeZanyat', NULL, NULL, NULL, NULL);


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO category VALUES (1, 'Ремонтный', 0, false, 'store');
INSERT INTO category VALUES (2, 'Продуктовый', 0, false, 'store');

INSERT INTO property VALUES (1, 'Паркова', 1, NULL, NULL);
INSERT INTO property VALUES (2, 'Пандус', 1, NULL, NULL);
INSERT INTO property VALUES (3, 'Банкомат', 2, NULL, NULL);
INSERT INTO property VALUES (4, 'Можно расплатиться картой', 2, NULL, NULL);

 
-- DOWN
DROP TABLE IF EXISTS buyer;
