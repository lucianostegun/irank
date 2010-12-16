--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

--
-- Name: to_ascii(bytea, name); Type: FUNCTION; Schema: public; Owner: root
--

CREATE FUNCTION to_ascii(bytea, name) RETURNS text
    LANGUAGE internal
    AS $$to_ascii_encname$$;


ALTER FUNCTION public.to_ascii(bytea, name) OWNER TO root;

--
-- Name: auxiliar_text_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE auxiliar_text_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.auxiliar_text_seq OWNER TO irank;

--
-- Name: auxiliar_text_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('auxiliar_text_seq', 33, true);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: auxiliar_text; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE auxiliar_text (
    id integer DEFAULT nextval('auxiliar_text_seq'::regclass) NOT NULL,
    description character varying(150),
    file_id integer,
    tag_name character varying(30),
    enabled boolean DEFAULT false,
    visible boolean DEFAULT true,
    locked boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.auxiliar_text OWNER TO irank;

--
-- Name: config; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE config (
    config_name character varying(50) NOT NULL,
    description character varying(150),
    config_value character varying(100) DEFAULT NULL::character varying,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.config OWNER TO irank;

--
-- Name: event_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE event_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.event_seq OWNER TO irank;

--
-- Name: event_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('event_seq', 34, true);


--
-- Name: event; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE event (
    id integer DEFAULT nextval('event_seq'::regclass) NOT NULL,
    ranking_id integer,
    event_name character varying(25),
    event_place character varying(250),
    paid_places integer,
    buyin double precision,
    event_date date,
    start_time time without time zone,
    comments character varying(140),
    sent_email boolean,
    invites integer DEFAULT 0,
    players integer DEFAULT 0,
    enabled boolean DEFAULT false,
    visible boolean DEFAULT true,
    locked boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    saved_result boolean DEFAULT false
);


ALTER TABLE public.event OWNER TO irank;

--
-- Name: event_comment_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE event_comment_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.event_comment_seq OWNER TO irank;

--
-- Name: event_comment_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('event_comment_seq', 4, true);


--
-- Name: event_comment; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE event_comment (
    id integer DEFAULT nextval('event_comment_seq'::regclass) NOT NULL,
    event_id integer NOT NULL,
    people_id integer NOT NULL,
    comment character varying(140) NOT NULL,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.event_comment OWNER TO irank;

--
-- Name: event_player; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE event_player (
    event_id integer NOT NULL,
    people_id integer NOT NULL,
    buyin double precision DEFAULT 0,
    rebuy double precision DEFAULT 0,
    addon double precision DEFAULT 0,
    event_position integer DEFAULT 0,
    prize double precision DEFAULT 0,
    enabled boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    confirm_code character varying(50),
    invite_status character varying(5) DEFAULT 'none'::character varying,
    allow_edit boolean DEFAULT false
);


ALTER TABLE public.event_player OWNER TO irank;

--
-- Name: faq_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE faq_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.faq_seq OWNER TO irank;

--
-- Name: faq_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('faq_seq', 2, true);


--
-- Name: faq; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE faq (
    id integer DEFAULT nextval('faq_seq'::regclass) NOT NULL,
    question character varying(200) NOT NULL,
    answer text,
    order_seq integer,
    visible boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.faq OWNER TO irank;

--
-- Name: file_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE file_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.file_seq OWNER TO irank;

--
-- Name: file_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('file_seq', 33, true);


--
-- Name: file; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE file (
    id integer DEFAULT nextval('file_seq'::regclass) NOT NULL,
    file_name character varying(200),
    file_path character varying(200),
    file_size integer,
    description character varying(250),
    is_image boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.file OWNER TO irank;

--
-- Name: log_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE log_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.log_seq OWNER TO irank;

--
-- Name: log_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('log_seq', 305, true);


--
-- Name: log; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE log (
    id integer DEFAULT nextval('log_seq'::regclass) NOT NULL,
    user_site_id integer,
    app character varying(60),
    module_name character varying(60),
    action_name character varying(60),
    message character varying(255),
    class_name character varying(50),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.log OWNER TO irank;

--
-- Name: log_field; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE log_field (
    log_id integer NOT NULL,
    field_name character varying(32) NOT NULL,
    field_value character varying(255),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.log_field OWNER TO irank;

--
-- Name: people_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE people_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.people_seq OWNER TO irank;

--
-- Name: people_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('people_seq', 20, true);


--
-- Name: people; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE people (
    id integer DEFAULT nextval('people_seq'::regclass) NOT NULL,
    people_type_id integer,
    first_name character varying(100),
    last_name character varying(100),
    full_name character varying(200),
    email_address character varying(200),
    birthday date,
    enabled boolean DEFAULT false,
    visible boolean DEFAULT true,
    locked boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.people OWNER TO irank;

--
-- Name: ranking_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE ranking_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.ranking_seq OWNER TO irank;

--
-- Name: ranking_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('ranking_seq', 3, true);


--
-- Name: ranking; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE ranking (
    id integer DEFAULT nextval('ranking_seq'::regclass) NOT NULL,
    ranking_name character varying(25),
    user_site_id integer NOT NULL,
    ranking_type_id integer,
    start_date date,
    finish_date date,
    is_private boolean DEFAULT false,
    players integer DEFAULT 0,
    events integer DEFAULT 0,
    enabled boolean DEFAULT false,
    visible boolean DEFAULT true,
    locked boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    default_buyin double precision DEFAULT 0,
    game_style_id integer
);


ALTER TABLE public.ranking OWNER TO irank;

--
-- Name: ranking_history; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE ranking_history (
    ranking_id integer NOT NULL,
    people_id integer NOT NULL,
    ranking_date date NOT NULL,
    events integer DEFAULT 0,
    score numeric(10,2) DEFAULT 0,
    ranking_position integer DEFAULT 0,
    balance_value double precision DEFAULT 0,
    prize_value double precision DEFAULT 0,
    paid_value double precision DEFAULT 0,
    total_ranking_position integer DEFAULT 0,
    total_events integer DEFAULT 0,
    total_score numeric(10,2) DEFAULT 0,
    total_balance double precision DEFAULT 0,
    total_prize double precision DEFAULT 0,
    total_paid double precision DEFAULT 0,
    enabled boolean DEFAULT true,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    average numeric(10,3) DEFAULT 0,
    total_average numeric(10,3) DEFAULT 0
);


ALTER TABLE public.ranking_history OWNER TO irank;

--
-- Name: ranking_player; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE ranking_player (
    ranking_id integer NOT NULL,
    people_id integer NOT NULL,
    total_events integer DEFAULT 0,
    total_score numeric(10,2) DEFAULT 0,
    total_balance double precision DEFAULT 0,
    total_prize double precision DEFAULT 0,
    total_paid double precision DEFAULT 0,
    enabled boolean DEFAULT true,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    total_average numeric(10,3) DEFAULT 0,
    allow_edit boolean DEFAULT false
);


ALTER TABLE public.ranking_player OWNER TO irank;

--
-- Name: virtual_table_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE virtual_table_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.virtual_table_seq OWNER TO irank;

--
-- Name: virtual_table_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('virtual_table_seq', 19, true);


--
-- Name: virtual_table; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE virtual_table (
    id integer DEFAULT nextval('virtual_table_seq'::regclass) NOT NULL,
    virtual_table_name character varying(20) NOT NULL,
    description character varying(100),
    tag_name character varying(50),
    enabled boolean DEFAULT false,
    visible boolean DEFAULT true,
    locked boolean DEFAULT false,
    deleted boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.virtual_table OWNER TO irank;

--
-- Name: ranking_type; Type: VIEW; Schema: public; Owner: irank
--

CREATE VIEW ranking_type AS
    SELECT virtual_table.id, virtual_table.description, virtual_table.tag_name, virtual_table.enabled, virtual_table.visible, virtual_table.locked, virtual_table.deleted, virtual_table.created_at, virtual_table.updated_at FROM virtual_table WHERE ((virtual_table.virtual_table_name)::text = 'rankingType'::text);


ALTER TABLE public.ranking_type OWNER TO irank;

--
-- Name: user_site_seq; Type: SEQUENCE; Schema: public; Owner: irank
--

CREATE SEQUENCE user_site_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.user_site_seq OWNER TO irank;

--
-- Name: user_site_seq; Type: SEQUENCE SET; Schema: public; Owner: irank
--

SELECT pg_catalog.setval('user_site_seq', 13, true);


--
-- Name: user_site; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE user_site (
    id integer DEFAULT nextval('user_site_seq'::regclass) NOT NULL,
    people_id integer,
    username character varying(20),
    password character varying(32),
    last_access_date timestamp without time zone,
    active boolean DEFAULT false,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    enabled boolean DEFAULT true,
    visible boolean DEFAULT true,
    deleted boolean DEFAULT false,
    locked boolean DEFAULT false
);


ALTER TABLE public.user_site OWNER TO irank;

--
-- Name: user_site_option; Type: TABLE; Schema: public; Owner: irank; Tablespace: 
--

CREATE TABLE user_site_option (
    people_id integer NOT NULL,
    user_site_option_id integer NOT NULL,
    option_value character varying(20),
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.user_site_option OWNER TO irank;

--
-- Data for Name: auxiliar_text; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY auxiliar_text (id, description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at) FROM stdin;
18	Template padrão de e-mail	18	emailTemplate	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
19	Template de e-mail para administração	19	emailTemplateAdmin	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
20	E-mail de boas vindas	20	signWelcome	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
21	E-mail de notificação inclusão em ranking	21	rankingPlayerAdd	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
22	E-mail de notificação de criação de evento	22	eventCreateNotify	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
23	E-mail de notificação de alteração de evento	23	eventChangeNotify	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
24	E-mail de notificação de resultado de evento	24	eventResult	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
25	E-mail de notificação de exclusão de evento	25	eventDeleteNotify	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
26	Convite de cadastro para novos usuários	26	newUserInvite	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
27	Notificação de confirmação de presença	27	confirmPresenceNotify	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
28	Lembrete de evento	28	eventReminder	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
29	E-mail para notificação de contato	29	contactMessage	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
30	E-mail de contato para feedback	30	feedbackMessage	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
31	Convite para ingressar ao site	31	friendInvite	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
32	Nova dúvida do FAQ	32	faqQuestion	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
33	Comentários no evento	33	eventCommentNotify	t	t	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
\.


--
-- Data for Name: config; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY config (config_name, description, config_value, created_at, updated_at) FROM stdin;
smtpHostname	Servidor SMTP	smtp.irank.com.br	2010-11-25 18:07:47.721417	2010-11-25 18:07:47.721417
smtpUsername	Usuário	noreply@irank.com.br	2010-11-25 18:07:47.721417	2010-11-25 18:07:47.721417
smtpPassword	Senha	noreply2010	2010-11-25 18:07:47.721417	2010-11-25 18:07:47.721417
emailSenderName	Remetente padrão	iRank	2010-11-25 18:07:47.721417	2010-11-25 18:07:47.721417
encodeEmailToUTF8	Codificar e-mail para UTF-8	\N	2010-11-25 18:07:47.721417	2010-11-25 18:07:47.721417
decodeEmailFromUTF8	Decodificar e-mail de UTF-8	\N	2010-11-25 18:07:47.721417	2010-11-25 18:07:47.721417
\.


--
-- Data for Name: event; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY event (id, ranking_id, event_name, event_place, paid_places, buyin, event_date, start_time, comments, sent_email, invites, players, enabled, visible, locked, deleted, created_at, updated_at, saved_result) FROM stdin;
12	1	Game #1	Casa do Reynaldo	2	10	2010-10-26	20:00:00	\N	\N	15	6	t	t	f	f	2010-11-16 13:03:48	2010-11-20 13:54:50	t
5	1	Game #1	Apê do Wagner	3	10	2010-09-21	20:00:00	\N	\N	15	7	t	t	f	f	2010-11-16 12:51:31	2010-11-20 13:53:33	t
1	1	Game #1	Apê do Wagner	3	10	2010-08-10	20:00:00	\N	\N	15	9	t	t	f	f	2010-11-16 12:47:45	2010-11-20 13:52:27	t
21	2	Game #2	Apê do Wagner	3	0	2010-10-26	21:30:00	\N	\N	8	5	t	t	f	f	2010-11-16 17:24:19	2010-11-17 00:16:42	t
14	1	Game #1	Apê do Wagner	2	10	2010-11-09	20:00:00	\N	\N	15	6	t	t	f	f	2010-11-16 13:05:11	2010-11-20 13:55:08	t
20	2	Game #2	Casa do Reynaldo	4	0	2010-10-05	21:30:00	\N	\N	8	6	t	t	f	f	2010-11-16 17:20:28	2010-11-17 00:15:04	t
7	1	Game #1	Casa do Reynaldo	3	10	2010-09-28	20:00:00	\N	\N	15	7	t	t	f	f	2010-11-16 12:54:11	2010-11-20 13:53:50	t
19	2	Game #2	Apê do Wagner	2	0	2010-09-08	21:30:00	\N	\N	8	5	t	t	f	f	2010-11-16 17:19:51	2010-11-20 13:34:01	t
16	1	Game #1	Apê do Luciano	3	10	2010-11-23	20:00:00	\N	\N	15	6	t	t	f	f	2010-11-16 13:06:30	2010-11-23 23:41:31	t
13	1	Game #2	Casa do Reynaldo	2	10	2010-10-26	21:30:00	\N	\N	15	6	t	t	f	f	2010-11-16 13:04:33	2010-11-16 14:47:18	t
2	1	Game #2	Apê do Wagner	3	10	2010-08-10	21:30:00	\N	\N	15	8	t	t	f	f	2010-11-16 12:49:25	2010-11-20 13:57:38	t
18	2	Game #2	Apê do Wagner	4	0	2010-08-17	21:30:00	\N	\N	8	4	t	t	f	f	2010-11-16 17:18:04	2010-11-20 13:33:50	t
15	1	Game #2	Apê do Wagner	2	10	2010-11-09	21:30:00	\N	\N	15	6	t	t	f	f	2010-11-16 13:05:38	2010-11-17 21:55:01	t
3	1	Game #1	Apê do Wagner	3	10	2010-08-24	20:00:00	\N	\N	15	8	t	t	f	f	2010-11-16 12:50:26	2010-11-20 13:52:57	t
17	2	Game #2	Apê do Luciano	3	10	2010-11-23	21:30:00	\N	\N	15	6	t	t	f	f	2010-11-16 13:07:29	2010-11-24 02:12:02	t
4	1	Game #2	Apê do Wagner	3	10	2010-08-24	21:30:00	\N	\N	15	8	t	t	f	f	2010-11-16 12:51:05	2010-11-16 14:34:52	t
6	1	Game #2	Apê do Wagner	3	10	2010-09-21	21:30:00	\N	\N	15	7	t	t	f	f	2010-11-16 12:52:14	2010-11-16 14:39:10	t
8	1	Game #2	Casa do Reynaldo	3	10	2010-09-28	21:30:00	\N	\N	15	7	t	t	f	f	2010-11-16 12:56:58	2010-11-16 14:43:05	t
11	1	Game #2	Apê do Wagner	3	10	2010-10-19	21:30:00	\N	\N	15	8	t	t	f	f	2010-11-16 13:03:01	2010-11-16 14:44:59	t
9	1	Game #1	Apê do Wagner	3	10	2010-10-05	20:00:00	\N	\N	15	7	t	t	f	f	2010-11-16 12:58:28	2010-11-20 13:54:04	t
10	1	Game #1	Apê do Wagner	3	10	2010-10-19	20:00:00	\N	\N	15	8	t	t	f	f	2010-11-16 13:02:24	2010-11-20 13:54:38	t
22	1	Poker night - Game #1	Apê do Wagner	3	10	2010-11-30	20:00:00	\N	t	15	3	t	f	t	t	2010-11-29 08:56:37	2010-12-06 16:46:28	f
23	1	Game #2	Apê do Wagner	3	10	2010-08-10	21:30:00	\N	\N	0	0	f	f	t	f	2010-11-25 18:20:36	2010-11-25 18:20:36	f
27	1	Game #1	Apê do Luciano	3	10	2010-11-23	20:00:00	\N	\N	0	0	f	f	t	t	2010-12-06 16:46:44	2010-12-06 16:47:07	f
24	1	Especial de fim de ano	Reyllagio	2	30	2010-12-21	20:00:00	Não esqueçam de chamar os amigos	t	19	7	t	t	t	f	2010-11-30 13:31:43	2010-12-16 03:10:48	f
30	1	Sig & Go - NLHE #1	AP do Wagner	2	10	2010-12-14	20:00:00	paga 3 posições se tiver mais que 10 buy-ins	t	18	5	t	t	t	t	2010-12-13 00:02:34	2010-12-15 02:14:06	f
25	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	f	f	t	f	2010-12-06 16:50:53	2010-12-06 16:50:53	f
26	1	Sit & Go - NLHE	Reyllagio	2	10	2010-12-07	20:00:00	+q 11 buy-in's = 3 posições pagas	t	17	6	t	t	t	f	2010-12-06 18:30:44	2010-12-08 09:05:03	t
34	1	Sit & Go - NLHE #2	AP 31 Cassinos Bar	2	10	2010-12-14	20:00:00	\N	\N	19	6	t	t	t	f	2010-12-15 02:17:51	2010-12-15 02:22:15	t
31	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	f	f	t	f	2010-12-14 17:46:00	2010-12-14 17:46:00	f
32	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	0	f	f	t	f	2010-12-15 02:10:22	2010-12-15 02:10:22	f
28	1	Evento #1	Apê do Luciano	3	10	2010-12-09	20:00:00	Observações	t	17	0	t	t	t	t	2010-12-09 01:37:26	2010-12-09 01:41:19	f
29	1	Sit & Go - NLHE #2	Reyllagio	2	10	2010-12-07	20:00:00	+q 11 buy-in's = 3 posições pagas	\N	17	6	t	t	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	t
33	1	Sit & Go - NLHE #1	AP 31 Cassinos Bar	2	10	2010-12-14	20:00:00	\N	\N	19	6	t	t	t	f	2010-12-15 02:14:19	2010-12-15 02:20:23	t
\.


--
-- Data for Name: event_comment; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY event_comment (id, event_id, people_id, comment, deleted, created_at, updated_at) FROM stdin;
1	24	1	Alô alô, testando nova funcionalidade de comentários dentro dos eventos\nQuem receber o e-mail da um reply ;)\nAguardando o poker da virada!!!	f	2010-12-16 03:10:21	2010-12-16 03:10:21
2	24	6	tah muito profissa esse site aki.\n\nmas o reply q vc pediu eh por aqui certo?\n\nabs	f	2010-12-16 08:10:20	2010-12-16 08:10:20
3	24	4	Aewewew.. poker da viradaaaaaaaaaa... seus pato, vou ganhar tudo e descontar pelo ano todo auhhuahuahuahua! :P	f	2010-12-16 10:14:52	2010-12-16 10:14:52
\.


--
-- Data for Name: event_player; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY event_player (event_id, people_id, buyin, rebuy, addon, event_position, prize, enabled, deleted, created_at, updated_at, confirm_code, invite_status, allow_edit) FROM stdin;
28	8	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	ZWQ2YzU5OGI4YzIwOTdmYmFjNmFhMTUzNmVmYzY0NGQ=	none	f
28	9	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	ZjVlYTMzNDhmNjkzMDJjNTdmNzdkMTJiYTE2MzBlM2E=	none	f
28	3	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	NmRjNjE5YTQ4YTRjZTg5YjI3ZTI0YTAwMTBjM2YwYzI=	none	f
28	10	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	YWYwZDBiNGQ0MGNmNGEzZjI5MzYxYjhiMTU0YTkyNWM=	none	f
28	7	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	ZjQ1MjA1ZThiZjc1Mjg1NDQyNjQ2NzNkNWU3MDNhNGQ=	none	f
28	18	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	OTdmOTc5NjUzMjkyZWNlOTE3OWEyNDlhM2U3MTE2ODM=	none	f
28	5	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	YWJiZTQ0NDAzZDczYzA3NjE1NjI1ZmM4OTBkYzNhODQ=	none	f
28	6	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	NjI2M2Q5MmZiOTBkYzNiMWQ3N2QzODFmNmRiMGMzYzQ=	none	f
28	1	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	YTA0NTk1MjU4ZTE0ODgyNjNiMTc5NmIwYWY4OTdiMGU=	none	f
28	17	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	ZTBmNDA3MDA5ZmE0NGZjNjI3Y2Y4N2VmMzE5NWEzNWU=	none	f
28	11	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	NjM2NzRiZmE0OTE2NTdmMzIwMGU1YjFkZmY2YjFmNDU=	none	f
28	12	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	MmUwMDUzNGJkM2JjMzExMzNjNDVjMjNiODI4NWZlMTk=	none	f
28	4	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	ZWExZWQ1NTJkYWZlMGE1OGU4NmRjMWQ4OTE0NTMxNDE=	none	f
28	15	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	YjUyMjBmNjY1NDBlOGY1Y2FhY2NmOTgxYmZmYmFhMGU=	none	f
28	14	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	YjJhYmE1NTI4ZGNmNGIwOWM5Yjk2ODE1YmY2ODJkNmM=	none	f
28	13	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	Zjc1MmJlNjVhN2UxNGYwNTM1N2M2N2QxNTYzZTExZjU=	none	f
28	2	0	0	0	0	0	f	f	2010-12-09 01:37:47	2010-12-09 01:37:47	MjI0NTYzMTg3OTAzMzFjYjgzZWFkNjViYzU5ZGIyNDg=	none	f
7	9	10	0	0	6	0	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
7	3	10	0	0	4	0	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
7	1	10	0	0	5	0	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
7	12	10	0	0	7	0	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
7	4	10	0	0	3	15	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
7	14	10	0	0	1	35	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
7	2	10	0	0	2	20	t	f	2010-11-16 12:56:54	2010-11-16 14:42:15	\N	yes	f
8	9	10	0	0	7	0	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
8	3	10	0	0	6	0	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
8	1	10	0	0	5	0	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
8	12	10	0	0	4	0	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
8	4	10	0	0	2	20	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
8	14	10	0	0	3	15	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
8	2	10	0	0	1	35	t	f	2010-11-16 12:57:43	2010-11-16 14:43:05	\N	yes	f
9	8	10	0	0	5	0	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
9	3	10	0	0	6	0	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
9	7	10	0	0	1	35	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
9	5	10	0	0	4	0	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
9	6	10	0	0	7	0	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
9	1	10	0	0	2	20	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
9	2	10	0	0	3	15	t	f	2010-11-16 13:02:21	2010-11-16 14:44:01	\N	yes	f
15	3	10	0	0	3	0	t	f	2010-11-16 13:05:55	2010-11-16 14:48:44	\N	yes	f
15	5	10	10	0	5	0	t	f	2010-11-16 13:05:55	2010-11-16 14:48:44	\N	yes	f
21	3	10	0	0	2	24	t	f	2010-11-16 17:24:41	2010-11-16 17:26:40	\N	yes	f
15	4	10	0	0	6	0	t	f	2010-11-16 13:05:55	2010-11-16 14:48:44	\N	yes	f
15	2	10	0	0	4	0	t	f	2010-11-16 13:05:55	2010-11-16 14:48:44	\N	yes	f
15	6	10	0	0	2	25	t	f	2010-11-16 13:05:55	2010-11-16 14:49:18	\N	yes	f
15	1	10	0	0	1	45	t	f	2010-11-16 13:05:55	2010-11-16 14:49:18	\N	yes	f
18	3	10	0	0	3	10	t	f	2010-11-16 17:19:12	2010-11-16 17:32:31	\N	yes	f
18	2	10	0	0	2	18.5	t	f	2010-11-16 17:19:12	2010-11-16 17:32:31	\N	yes	f
18	9	10	10	0	1	25.5	t	f	2010-11-16 17:19:12	2010-11-16 17:32:39	\N	yes	f
18	4	10	10	0	4	6	t	f	2010-11-16 17:19:12	2010-11-16 17:32:39	\N	yes	f
20	3	7	0	0	4	7.75	t	f	2010-11-16 17:24:10	2010-11-16 17:28:50	\N	yes	f
21	6	10	10	0	3	10	t	f	2010-11-16 17:24:41	2010-11-16 17:26:40	\N	yes	f
21	1	10	0	0	1	36	t	f	2010-11-16 17:24:41	2010-11-16 17:26:40	\N	yes	f
21	4	10	0	0	4	0	t	f	2010-11-16 17:24:41	2010-11-16 17:26:40	\N	yes	f
21	2	10	10	0	5	0	t	f	2010-11-16 17:24:41	2010-11-16 17:26:40	\N	yes	f
20	7	10	10	0	5	0	t	f	2010-11-16 17:24:10	2010-11-17 00:15:04	\N	yes	f
20	5	10	10	0	6	0	t	f	2010-11-16 17:24:10	2010-11-17 00:15:04	\N	yes	f
20	6	10	0	0	3	12.25	t	f	2010-11-16 17:24:10	2010-11-17 00:15:04	\N	yes	f
20	1	10	0	0	1	40.850000000000001	t	f	2010-11-16 17:24:10	2010-11-17 00:15:04	\N	yes	f
20	2	10	10	0	2	26.149999999999999	t	f	2010-11-16 17:24:10	2010-11-17 00:15:04	\N	yes	f
19	3	10	0	0	3	0	t	f	2010-11-16 17:20:26	2010-11-16 17:31:18	\N	yes	f
19	6	10	10	0	4	0	t	f	2010-11-16 17:20:26	2010-11-16 17:31:18	\N	yes	f
19	1	10	0	0	2	21	t	f	2010-11-16 17:20:26	2010-11-16 17:31:18	\N	yes	f
19	4	10	10	0	5	0	t	f	2010-11-16 17:20:26	2010-11-16 17:31:18	\N	yes	f
19	2	10	0	0	1	49	t	f	2010-11-16 17:20:26	2010-11-16 17:31:18	\N	yes	f
14	6	10	0	0	3	0	t	f	2010-11-16 13:05:37	2010-11-16 14:48:01	\N	yes	f
14	1	10	0	0	4	0	t	f	2010-11-16 13:05:37	2010-11-16 14:48:01	\N	yes	f
1	15	10	0	0	2	30	t	f	2010-11-16 12:48:57	2010-11-16 13:18:57	\N	yes	f
1	2	10	0	0	1	50	t	f	2010-11-16 12:48:57	2010-11-16 13:18:57	\N	yes	f
1	3	10	0	0	4	0	t	f	2010-11-16 12:48:57	2010-11-16 13:20:18	\N	yes	f
1	10	10	0	0	5	0	t	f	2010-11-16 12:48:57	2010-11-16 13:20:18	\N	yes	f
11	3	10	0	0	3	15	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
1	4	10	10	0	3	20	t	f	2010-11-16 12:48:57	2010-11-16 13:18:57	\N	yes	f
1	7	10	0	0	6	0	t	f	2010-11-16 12:48:57	2010-11-16 13:20:18	\N	yes	f
1	5	10	0	0	9	0	t	f	2010-11-16 12:48:57	2010-11-16 13:20:18	\N	yes	f
1	6	10	0	0	7	0	t	f	2010-11-16 12:48:57	2010-11-16 13:20:18	\N	yes	f
1	1	10	0	0	8	0	t	f	2010-11-16 12:48:57	2010-11-16 13:20:18	\N	yes	f
14	4	10	0	0	6	0	t	f	2010-11-16 13:05:37	2010-11-16 14:48:01	\N	yes	f
2	2	10	0	0	1	45	t	f	2010-11-16 12:50:01	2010-11-16 13:26:43	\N	yes	f
2	7	10	0	0	5	0	t	f	2010-11-16 12:50:01	2010-11-16 13:28:27	\N	yes	f
2	5	10	0	0	6	0	t	f	2010-11-16 12:50:01	2010-11-16 13:28:27	\N	yes	f
14	2	10	0	0	2	25	t	f	2010-11-16 13:05:37	2010-11-16 14:48:01	\N	yes	f
2	1	10	0	0	4	0	t	f	2010-11-16 12:50:01	2010-11-16 13:28:27	\N	yes	f
2	3	10	0	0	2	30	t	f	2010-11-16 12:50:01	2010-11-16 13:29:02	\N	yes	f
2	6	10	0	0	3	15	t	f	2010-11-16 12:50:01	2010-11-16 13:29:02	\N	yes	f
2	4	10	10	0	7	0	t	f	2010-11-16 12:50:01	2010-11-16 13:29:02	\N	yes	f
2	15	10	0	0	8	0	t	f	2010-11-16 12:50:01	2010-11-16 13:29:02	\N	yes	f
3	3	10	0	0	6	0	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	7	10	0	0	4	0	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	5	10	0	0	8	0	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	6	10	10	0	2	30	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	1	10	0	0	3	20	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	4	10	10	0	7	0	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	15	10	0	0	1	50	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
3	2	10	0	0	5	0	t	f	2010-11-16 12:51:04	2010-11-16 13:32:35	\N	yes	f
4	3	10	0	0	1	45	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	7	10	0	0	3	18	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	5	10	0	0	7	0	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	6	10	0	0	4	0	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	1	10	0	0	6	0	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	4	10	10	0	5	0	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	15	10	0	0	8	0	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
4	2	10	10	0	2	27	t	f	2010-11-16 12:51:25	2010-11-16 14:34:52	\N	yes	f
5	3	10	0	0	2	20	t	f	2010-11-16 12:52:09	2010-11-16 14:36:56	\N	yes	f
5	7	10	0	0	6	0	t	f	2010-11-16 12:52:09	2010-11-16 14:36:56	\N	yes	f
5	6	10	0	0	1	35	t	f	2010-11-16 12:52:09	2010-11-16 14:36:56	\N	yes	f
5	1	10	0	0	4	0	t	f	2010-11-16 12:52:09	2010-11-16 14:36:56	\N	yes	f
5	4	10	0	0	3	15	t	f	2010-11-16 12:52:09	2010-11-16 14:36:57	\N	yes	f
5	13	10	0	0	7	0	t	f	2010-11-16 12:52:09	2010-11-16 14:36:57	\N	yes	f
5	2	10	0	0	5	0	t	f	2010-11-16 12:52:09	2010-11-16 14:36:57	\N	yes	f
6	3	10	0	0	4	0	t	f	2010-11-16 12:52:32	2010-11-16 14:39:10	\N	yes	f
6	6	10	0	0	3	15	t	f	2010-11-16 12:52:32	2010-11-16 14:39:10	\N	yes	f
6	1	10	0	0	2	25	t	f	2010-11-16 12:52:32	2010-11-16 14:39:10	\N	yes	f
6	4	10	0	0	1	40	t	f	2010-11-16 12:52:32	2010-11-16 14:39:10	\N	yes	f
6	13	10	0	0	7	0	t	f	2010-11-16 12:52:32	2010-11-16 14:39:10	\N	yes	f
6	2	10	0	0	5	0	t	f	2010-11-16 12:52:32	2010-11-16 14:39:10	\N	yes	f
6	7	10	10	0	6	0	t	f	2010-11-16 12:52:32	2010-11-16 14:41:22	\N	yes	f
10	3	10	0	0	8	0	t	f	2010-11-16 13:02:56	2010-11-16 14:45:48	\N	yes	f
10	7	10	0	0	3	15	t	f	2010-11-16 13:02:56	2010-11-16 14:45:48	\N	yes	f
10	5	10	0	0	1	40	t	f	2010-11-16 13:02:56	2010-11-16 14:45:48	\N	yes	f
10	6	10	0	0	7	0	t	f	2010-11-16 13:02:56	2010-11-16 14:45:48	\N	yes	f
10	1	10	0	0	4	0	t	f	2010-11-16 13:02:56	2010-11-16 14:45:48	\N	yes	f
10	11	10	0	0	6	0	t	f	2010-11-16 13:02:56	2010-11-16 14:45:48	\N	yes	f
13	5	10	0	0	5	0	t	f	2010-11-16 13:04:58	2010-11-16 14:47:18	\N	yes	f
10	2	10	0	0	5	0	t	f	2010-11-16 13:02:56	2010-11-16 14:45:49	\N	yes	f
12	3	10	0	0	1	40	t	f	2010-11-16 13:04:18	2010-11-16 14:46:45	\N	yes	f
12	5	10	0	0	4	0	t	f	2010-11-16 13:04:18	2010-11-16 14:46:45	\N	yes	f
12	6	10	0	0	6	0	t	f	2010-11-16 13:04:18	2010-11-16 14:46:45	\N	yes	f
12	1	10	0	0	5	0	t	f	2010-11-16 13:04:18	2010-11-16 14:46:45	\N	yes	f
12	4	10	0	0	3	0	t	f	2010-11-16 13:04:18	2010-11-16 14:46:45	\N	yes	f
12	2	10	0	0	2	20	t	f	2010-11-16 13:04:18	2010-11-16 14:46:45	\N	yes	f
13	3	10	0	0	4	0	t	f	2010-11-16 13:04:58	2010-11-16 14:47:18	\N	yes	f
13	6	10	0	0	2	20	t	f	2010-11-16 13:04:58	2010-11-16 14:47:18	\N	yes	f
13	1	10	0	0	3	0	t	f	2010-11-16 13:04:58	2010-11-16 14:47:18	\N	yes	f
13	4	10	0	0	1	40	t	f	2010-11-16 13:04:58	2010-11-16 14:47:18	\N	yes	f
13	2	10	0	0	6	0	t	f	2010-11-16 13:04:58	2010-11-16 14:47:18	\N	yes	f
14	3	10	0	0	1	45	t	f	2010-11-16 13:05:37	2010-11-16 14:48:01	\N	yes	f
14	5	10	10	0	5	0	t	f	2010-11-16 13:05:37	2010-11-16 14:48:01	\N	yes	f
11	7	10	0	0	6	0	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
11	5	10	0	0	2	30	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
11	6	10	0	0	1	45	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
11	1	10	0	0	7	0	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
11	11	10	0	0	8	0	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
11	4	10	0	0	4	0	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
11	2	10	10	0	5	0	t	f	2010-11-16 13:03:35	2010-11-16 14:44:59	\N	yes	f
10	4	10	0	0	2	25	t	f	2010-11-16 13:02:56	2010-11-16 14:45:49	\N	yes	f
16	3	10	0	0	2	33	t	f	2010-11-16 13:06:59	2010-11-23 23:41:29	\N	yes	f
16	5	10	0	10	6	0	t	f	2010-11-16 13:06:59	2010-11-23 23:41:29	\N	yes	f
16	6	10	10	10	1	55	t	f	2010-11-16 13:06:59	2010-11-23 23:41:30	\N	yes	f
16	1	10	0	10	4	0	t	f	2010-11-16 13:06:59	2010-11-23 23:41:30	\N	yes	f
16	4	10	0	0	3	22	t	f	2010-11-16 13:06:59	2010-11-23 23:41:30	\N	yes	f
16	2	10	0	10	5	0	t	f	2010-11-16 13:06:59	2010-11-23 23:41:31	\N	yes	f
17	3	10	0	0	1	38.5	t	f	2010-11-16 13:07:49	2010-11-24 02:12:02	\N	yes	f
17	5	10	0	0	5	0	t	f	2010-11-16 13:07:49	2010-11-24 02:12:02	\N	yes	f
17	6	10	0	0	4	0	t	f	2010-11-16 13:07:49	2010-11-24 02:12:02	\N	yes	f
17	1	10	0	0	2	34	t	f	2010-11-16 13:07:49	2010-11-24 02:12:02	\N	yes	f
17	4	10	10	0	3	2.5	t	f	2010-11-16 13:07:49	2010-11-24 02:12:43	\N	yes	f
17	2	10	5	0	6	0	t	f	2010-11-16 13:07:49	2010-11-24 02:12:02	\N	yes	f
22	3	0	0	0	0	0	t	f	2010-11-29 08:57:20	2010-11-29 14:18:59	\N	yes	f
22	1	0	0	0	0	0	t	f	2010-11-29 08:57:20	2010-11-29 09:01:13	\N	yes	f
22	2	0	0	0	0	0	t	f	2010-11-29 08:57:20	2010-11-29 14:25:23	\N	yes	f
26	9	10	10	0	6	0	t	f	2010-12-06 18:32:36	2010-12-08 09:05:03	\N	yes	f
26	3	10	10	0	5	0	t	f	2010-12-06 18:32:36	2010-12-08 09:05:03	\N	yes	f
26	6	10	0	0	3	0	t	f	2010-12-06 18:32:36	2010-12-08 09:05:03	\N	yes	f
26	1	10	10	0	2	30	t	f	2010-12-06 18:32:36	2010-12-08 09:05:03	\N	yes	f
26	4	10	0	0	4	0	t	f	2010-12-06 18:32:36	2010-12-08 09:05:03	\N	yes	f
26	2	10	0	0	1	60	t	f	2010-12-06 18:32:36	2010-12-08 09:05:03	\N	yes	f
34	6	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	ZDhmODFkMzllNzk5NTgwMDVjNjg1MWEyMWU1Y2VlYTU=	none	f
34	1	10	10	0	4	0	t	f	2010-12-15 02:17:51	2010-12-15 02:22:14	Y2ZiNDVhNGZjYTkxN2E2MWMwMjk5OGExOWEwNDlhMGY=	yes	f
34	17	10	0	0	6	0	t	f	2010-12-15 02:17:51	2010-12-15 02:22:15	ZWNhZjVkZTJkMzI3ZDcxZTVlZTYwOWM0ODFlOTBjYTY=	yes	f
29	9	10	0	0	4	0	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	\N	yes	f
29	3	10	0	0	6	0	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	\N	yes	f
29	6	10	0	0	5	0	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	\N	yes	f
29	1	10	0	0	1	40	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	\N	yes	f
29	4	10	0	0	3	0	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	\N	yes	f
29	2	10	0	0	2	20	t	f	2010-12-08 09:06:16	2010-12-08 09:07:34	\N	yes	f
18	7	0	0	0	0	0	f	f	2010-11-16 17:19:12	2010-11-16 17:19:12	\N	no	f
18	5	0	0	0	0	0	f	f	2010-11-16 17:19:12	2010-11-16 17:19:12	\N	no	f
18	6	0	0	0	0	0	f	f	2010-11-16 17:19:12	2010-11-16 17:19:12	\N	no	f
18	1	0	0	0	0	0	f	f	2010-11-16 17:19:12	2010-11-16 17:19:12	\N	no	f
19	9	0	0	0	0	0	f	f	2010-11-16 17:20:26	2010-11-16 17:20:26	\N	no	f
19	7	0	0	0	0	0	f	f	2010-11-16 17:20:26	2010-11-16 17:20:26	\N	no	f
19	5	0	0	0	0	0	f	f	2010-11-16 17:20:26	2010-11-16 17:20:26	\N	no	f
20	9	0	0	0	0	0	f	f	2010-11-16 17:24:10	2010-11-16 17:24:10	\N	no	f
20	4	0	0	0	0	0	f	f	2010-11-16 17:24:10	2010-11-16 17:24:10	\N	no	f
21	9	0	0	0	0	0	f	f	2010-11-16 17:24:41	2010-11-16 17:24:41	\N	no	f
21	7	0	0	0	0	0	f	f	2010-11-16 17:24:41	2010-11-16 17:24:41	\N	no	f
21	5	0	0	0	0	0	f	f	2010-11-16 17:24:41	2010-11-16 17:24:41	\N	no	f
6	8	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
16	11	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
16	12	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
6	9	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
16	15	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
16	14	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
16	13	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
6	10	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
17	8	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	9	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
6	5	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
17	10	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	7	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	11	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	12	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	15	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	14	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
17	13	0	0	0	0	0	f	f	2010-11-16 13:07:49	2010-11-16 13:07:49	\N	no	f
8	7	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
8	5	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
8	6	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
8	11	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
8	15	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
8	13	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
9	9	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	10	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	11	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	12	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	4	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	15	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	14	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
9	13	0	0	0	0	0	f	f	2010-11-16 13:02:21	2010-11-16 13:02:21	\N	no	f
10	8	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
10	9	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
10	10	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
10	12	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
10	15	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
10	14	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
10	13	0	0	0	0	0	f	f	2010-11-16 13:02:56	2010-11-16 13:02:56	\N	no	f
11	8	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
11	9	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
11	10	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
11	12	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
11	15	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
11	14	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
11	13	0	0	0	0	0	f	f	2010-11-16 13:03:35	2010-11-16 13:03:35	\N	no	f
12	8	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	9	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	10	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	7	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	11	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	12	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	15	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	14	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
12	13	0	0	0	0	0	f	f	2010-11-16 13:04:18	2010-11-16 13:04:18	\N	no	f
13	8	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	9	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	10	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	7	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	11	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	12	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	15	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	14	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
13	13	0	0	0	0	0	f	f	2010-11-16 13:04:58	2010-11-16 13:04:58	\N	no	f
14	8	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	9	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	10	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	7	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	11	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	12	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	15	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	14	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
14	13	0	0	0	0	0	f	f	2010-11-16 13:05:37	2010-11-16 13:05:37	\N	no	f
15	8	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-16 13:05:55	\N	no	f
15	9	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-16 13:05:55	\N	no	f
15	10	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-16 13:05:55	\N	no	f
15	7	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-16 13:05:55	\N	no	f
3	13	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
4	8	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
4	9	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
4	10	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
16	8	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
16	9	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
6	11	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
16	10	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
16	7	0	0	0	0	0	f	f	2010-11-16 13:06:59	2010-11-16 13:06:59	\N	no	f
2	8	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
2	9	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
2	10	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
2	11	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
2	12	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
2	14	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
2	13	0	0	0	0	0	f	f	2010-11-16 12:50:01	2010-11-16 12:50:01	\N	no	f
3	8	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
3	9	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
3	10	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
3	11	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
3	12	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
3	14	0	0	0	0	0	f	f	2010-11-16 12:51:04	2010-11-16 12:51:04	\N	no	f
4	11	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
4	12	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
4	14	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
4	13	0	0	0	0	0	f	f	2010-11-16 12:51:25	2010-11-16 12:51:25	\N	no	f
5	8	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	9	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	10	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	5	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	11	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	12	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	15	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
5	14	0	0	0	0	0	f	f	2010-11-16 12:52:09	2010-11-16 12:52:09	\N	no	f
6	12	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
6	15	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
6	14	0	0	0	0	0	f	f	2010-11-16 12:52:32	2010-11-16 12:52:32	\N	no	f
7	8	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	10	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	7	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	5	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	6	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	11	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	15	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
7	13	0	0	0	0	0	f	f	2010-11-16 12:56:54	2010-11-16 12:56:54	\N	no	f
8	8	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
8	10	0	0	0	0	0	f	f	2010-11-16 12:57:43	2010-11-16 12:57:43	\N	no	f
15	13	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-17 21:55:00	\N	no	f
15	14	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-17 21:54:54	\N	no	f
15	15	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-17 21:54:49	\N	no	f
15	12	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-17 21:54:44	\N	no	f
15	11	0	0	0	0	0	f	f	2010-11-16 13:05:55	2010-11-17 21:54:42	\N	no	f
1	8	0	0	0	0	0	f	f	2010-11-16 12:48:57	2010-11-16 12:48:57	\N	no	f
1	9	0	0	0	0	0	f	f	2010-11-16 12:48:57	2010-11-16 12:48:57	\N	no	f
1	11	0	0	0	0	0	f	f	2010-11-16 12:48:57	2010-11-16 12:48:57	\N	no	f
1	12	0	0	0	0	0	f	f	2010-11-16 12:48:57	2010-11-16 12:48:57	\N	no	f
1	14	0	0	0	0	0	f	f	2010-11-16 12:48:57	2010-11-16 12:48:57	\N	no	f
1	13	0	0	0	0	0	f	f	2010-11-16 12:48:57	2010-11-16 12:48:57	\N	no	f
23	8	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	9	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	3	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	10	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	7	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	5	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	6	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	1	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	11	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	12	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	4	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	15	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	14	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	13	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
23	2	0	0	0	0	0	f	f	2010-11-25 18:20:36	2010-11-25 18:20:36	\N	no	f
22	8	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	9	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	10	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	7	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	5	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	6	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	11	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	12	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	4	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	15	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	14	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
22	13	0	0	0	0	0	f	f	2010-11-29 08:57:20	2010-11-29 08:57:20	\N	no	f
27	8	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	9	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	3	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	10	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	7	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	5	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	6	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	1	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	11	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	12	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	4	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	15	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	14	0	0	0	0	0	f	f	2010-12-06 16:46:44	2010-12-06 16:46:44	\N	no	f
27	13	0	0	0	0	0	f	f	2010-12-06 16:46:45	2010-12-06 16:46:45	\N	no	f
27	2	0	0	0	0	0	f	f	2010-12-06 16:46:45	2010-12-06 16:46:45	\N	no	f
26	8	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	10	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	7	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	18	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	5	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	11	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	17	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	12	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	15	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	14	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
26	13	0	0	0	0	0	f	f	2010-12-06 18:32:36	2010-12-06 18:32:36	\N	no	f
29	8	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	10	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	7	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	18	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	5	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	17	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	11	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	12	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	15	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	14	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
29	13	0	0	0	0	0	f	f	2010-12-08 09:06:16	2010-12-08 09:06:16	\N	no	f
34	11	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	ZTUwZjIyMWM0MDg2ZTFjNzc4NzNiM2E3YTY2YTBmYTI=	none	f
34	12	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	NGQ1MGZkNTkxNjk1MmUxNzY0ZmVkOTAwNDZjYWIwOWE=	none	f
24	3	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 17:59:46	NTlmM2Q0ZjhiN2Y2NGI4ZTFjNTJmYzIzM2UxZjRhN2I=	yes	f
34	4	10	10	0	3	0	t	f	2010-12-15 02:17:51	2010-12-15 02:22:15	YTZmNWU3YTgwZGY1NjVhZTE3YzNmMmI3ZmEwMmRiNGQ=	yes	f
34	15	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	ODIwYzJlOTYyNjA5YmQxZjc4YjYzZjIxYjRkMDA1Y2Y=	none	f
34	14	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	NTA1ZTdkZWQwYzU5YzEzNzJiZmNhZmEyY2JmYTVmNWI=	none	f
34	13	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	NWU2OGU1MjI5MWRiMjA3MDU1NjA0Y2I1YmI0NDYzYzY=	none	f
34	2	10	0	0	1	50	t	f	2010-12-15 02:17:51	2010-12-15 02:22:15	MjUxNWRjZjVlOWJlMTQ0MzFhMDMzOTBhMDRiMWIwYzc=	yes	f
34	8	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	YzVlNzNmZDBmNjJmNjM3YzBmN2JlMWUwOGNjYTEwYWU=	none	f
34	9	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	MTAxZGNkN2YxYjljZjQxNTRhZjlmNTk0NTJiZGE4NzM=	none	f
24	19	0	0	0	0	0	f	f	2010-12-12 23:59:11	2010-12-12 23:59:11	YzRhMmYxZDI5MDc3YzgxNGNkYWRmNTE5OTljMGVjZWE=	none	f
30	8	0	0	0	0	0	f	f	2010-12-13 00:17:29	2010-12-13 00:17:29	YzE0M2U1MWIwMDYwYjlkYzdlYWUzNmRmZDQyMDBlMzI=	none	f
30	9	0	0	0	0	0	f	f	2010-12-13 00:17:29	2010-12-13 00:17:29	ZjljOWUxYzVkZjU2ZWEyNmYxZWRmOTQ5YTVhZTJhZTU=	none	f
30	3	0	0	0	0	0	f	f	2010-12-13 00:17:29	2010-12-13 00:17:29	YTliODgwZGEyZGY3NTE0ZjE2MmJkZTA3ZWJlYTkzYTY=	none	f
30	10	0	0	0	0	0	f	f	2010-12-13 00:17:29	2010-12-13 00:17:29	OWU3Nzc5MWQwMmFjNWY4YWVjZDQ5ZDgyNzY1MGRkNGU=	none	f
30	7	0	0	0	0	0	t	f	2010-12-13 00:17:30	2010-12-14 17:46:37	OGQzNmVjYTE0NzA2OTM0ODg0MWZmMDg1MzZkMDBjNjY=	yes	f
30	19	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	NDk4YzE2ZmE1MmVlYjBhMGJjYmM3Yjg4NDRmZjc4M2E=	none	f
30	18	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	Y2MzOGQ2NTI5OTA5ZWIyNDM4ZjhiZTVhNTllNmY2YWQ=	none	f
30	5	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	M2JmZWI4OWM2Y2EzZjE0MWYxNWUxZDc4YjA1OTdkOGI=	none	f
30	6	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	MDIxYmY3NDY3NTdkOTdjNjdlMWUxMGQ4NjZiZjNhZDA=	none	f
30	1	0	0	0	0	0	t	f	2010-12-13 00:17:30	2010-12-13 09:11:40	ODZjYmFlYzliMGEzM2QwMmMxOWFjMWI4MTM0OGY4NTY=	yes	f
30	17	0	0	0	0	0	t	f	2010-12-13 00:17:30	2010-12-13 08:37:29	OTA1ZTIxZmFkNzYwYTk0OTY5N2JmODJkNjM4MWVjZDI=	yes	f
30	11	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	NjAxNTQ2N2Q0MWI2YzNjNzk0YTE5ZGRkYmRhM2I3NDQ=	none	f
30	12	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	ZDE0NzRkMTdlYzE3NGMyNGMxYThlOTBiZGUyZjY0Y2U=	none	f
30	4	0	0	0	0	0	t	f	2010-12-13 00:17:30	2010-12-14 10:44:11	ODNjODRkZmQ3NzhjOTUzOTE5MDc5ZWMwYzUwMDZlMTY=	yes	f
30	15	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	MDNlNTRhOGI2ZGU0ZGQ2OTg4OTkwN2JkZGIxYzE5NDI=	none	f
30	14	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	MGVkNDVjN2M4MDliZWU2YWZiZGU0NjZhMTk3N2ZlNmU=	none	f
30	13	0	0	0	0	0	f	f	2010-12-13 00:17:30	2010-12-13 00:17:30	MjA3M2ZkNTZmNWFmYzUyZDIyMWM4MGU5ZGY5OGQ5NzE=	none	f
30	2	0	0	0	0	0	t	f	2010-12-13 00:17:30	2010-12-13 00:17:34	YjNlNWNlYTgzZjY4NmU4OGJhOTlmYmFjNTliNWIyNDI=	yes	f
34	3	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	ZTE5YWExYmIxNzYzOWY3YTY1MGE4YTgxNDBlNjJlOTE=	none	f
24	9	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 17:36:54	ZmY3ZTRlYzUzZjhjNmFlNWI5ZTM0NDRkMjRmY2QxYjI=	yes	f
24	6	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 18:13:45	ZGZmYmVkYTg5YWQzNTRiNjkxMWFlY2VmMjM0ODg4Yzc=	yes	f
34	10	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	NTQ2Njc4N2RkYmRhMGQ4ZTBjN2M5YTMxZDc4ZDI5YzY=	none	f
34	7	10	0	0	5	0	t	f	2010-12-15 02:17:51	2010-12-15 02:22:14	MzVmZDFkOTNlMzhmNGEwYzBlZTgxZDI2NzVmMTUzYjQ=	yes	f
24	8	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	MGNhMTMwZTBkYWYwY2QxZWIzZGRkMWRlZmRhOTQ0NTU=	none	f
24	10	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	YjM1MTljYjUyODlkMjkwZWQ0YTAwNTI3M2YxZDNkNWQ=	none	f
24	7	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	OTAxYTY4NzYxNjgxNGVhODE4NWQ4MjI2YmFjOWNjMTM=	none	f
24	18	0	0	0	0	0	f	f	2010-12-06 18:30:28	2010-12-14 18:13:58	ODA0ZDhiOThhMWJlMzM3MmNjNDg0N2RiZDk4Njg2ZDk=	none	f
24	5	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 18:13:58	YTVlOGZhZjMxYjIzNmEzYTQ3Nzk2ZWVkZDVlNmU5ZTU=	yes	f
24	1	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 18:13:58	NWYzMjIzZWFkZjBjZTczODNjNWM0YzkxZWIwMjVlYWY=	yes	f
24	17	0	0	0	0	0	f	f	2010-12-06 18:29:33	2010-12-14 18:13:58	Yjk5ZWE0MTMyMDQxZjkzZDAyMDZkYWY5ZmEzZDcxZjA=	none	f
24	11	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	NjBhNDM3N2NiOTlkYjE2NmFlZTJlODA2MWI1NWIzYTE=	none	f
24	12	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	NjlkYTA0NjQ3MTMzMjdkY2M3YWNjZGJmOTcyYjUxNjc=	none	f
24	4	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 18:13:58	NzAyZjcxMTA1OWVmOWVmOWI0YjJiYjZlMDYxOWJiMDY=	yes	f
24	15	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	YzM2MWQ0MmJhMTZjYzZiNjYwY2E0MGFlMTY3ZDYzYWI=	none	f
24	14	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	M2ZhOTFjNTcwMzQzMjZmZjA4OWNlYjZmNDg5MzFmYzY=	none	f
24	13	0	0	0	0	0	f	f	2010-11-30 13:36:37	2010-12-14 18:13:58	ZmMwNDBlMTUzNjRhYmUyZjY0NmJjOTdmNzU3NmI5YjA=	none	f
24	2	0	0	0	0	0	t	f	2010-11-30 13:36:37	2010-12-14 18:13:58	NjU1MmUwYmYyMDE5YjliZmYzZWQ1OWQzNGY2NTc2NGE=	yes	f
24	20	0	0	0	0	0	f	f	2010-12-15 02:13:06	2010-12-15 02:13:06	MWRkZWY1MDYxMWQ0YzhlMzIyYjM5NGZjNGY5NTJlN2M=	none	f
33	8	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	YmUxMGFmYWJkZDgwNGNmZGUxNDBiNGNjMWQ4MTNlN2E=	none	f
33	9	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	ZDRlZDQzNDA1YzlmZjgyOThiYzAzZTRhOTBkZmYyNGI=	none	f
33	3	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	OTdhNmE3ZDFlMmNjZDA3ZGRiMjYzZThlZTI1YmE1YTE=	none	f
33	10	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	MGY1NzE3M2EyOGEwNzgxNDY5MTdhZWZlMDMzNTU2N2I=	none	f
34	19	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	ODI2ZjQ4ZmY4MjllMDU0Y2ZhYjA4ZWNhNGE1OWU3YjE=	none	f
33	19	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	NjBkNjk4YTY3NTIzMTQ2YzM5MjNhYzIxMjBjMzE4ODQ=	none	f
34	20	10	0	0	2	30	t	f	2010-12-15 02:17:51	2010-12-15 02:22:14	Yzc2NGJjOGFkYjU5ZDcxZDU0NDkyMTdlMTY5MGYxMmM=	yes	f
33	18	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	NjA0MmE5MmIyNjE1Y2JiMTUyMjUzNDJiNTA3ZDQ1MjU=	none	f
33	5	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	ODJlYjg2OTUxZjc2ZTI1NGIyZjBmOWM4MzE0MTI1NjY=	none	f
33	6	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	NDQ4ZWZmZDEzOThiNjAxOWZlN2NlYTVmOTVkNDY3MTI=	none	f
34	18	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	ODcxNDE2ODFhYjc2NWRlYjFkZjQ1YzdiNGE0YWU1NDg=	none	f
34	5	0	0	0	0	0	f	f	2010-12-15 02:17:51	2010-12-15 02:18:09	YjFhOWVmNzZkNTk4N2QyYmNlMjQ0Y2Q1ZWVmNGRlNmY=	none	f
33	11	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	MWU3Yzc3ODM1NmY1ZTlhYmI2MDhjZWZhZGZkMDhlNjI=	none	f
33	12	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	OTk4NmFkN2E5NTZlOWZiZTI0NTNkOWU0OTM1NWZkY2U=	none	f
33	7	10	0	0	4	0	t	f	2010-12-15 02:17:17	2010-12-15 02:20:23	MGQ2M2YyNzYyOWJlMjM5NjVmY2YzNjYwNzFjY2ZjOWI=	yes	f
33	15	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	YjYzNGY5ZDM1MDZmNWY0YWVjNmRjODU4MjZiMDNmYjc=	none	f
33	14	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	MTFkNDA1Mjc2MDEzZjFkZTI1YjVkOTM5ZDE5ZTgwYTk=	none	f
33	13	0	0	0	0	0	f	f	2010-12-15 02:17:17	2010-12-15 02:17:17	NDZmZjViOTliNTMyOGRmYTY5Mzg5MWI2YzA3NTExMTg=	none	f
33	20	10	0	0	2	20	t	f	2010-12-15 02:17:17	2010-12-15 02:20:23	YzlhNzUzNmQxOGVlNDAwZmRlYmIyZDQxNGZiN2Q1NTA=	yes	f
33	1	10	0	0	6	0	t	f	2010-12-15 02:17:17	2010-12-15 02:20:23	MThkODE5MGNkOTBlNDE1OGI5MjZjMDdiYzYxODNkY2M=	yes	f
33	17	10	0	0	1	40	t	f	2010-12-15 02:17:17	2010-12-15 02:20:23	NGE1MDNhOWMwYzBjMWQzYzY1OTU0MjUxZjcwOWFiZTc=	yes	f
33	4	10	0	0	3	0	t	f	2010-12-15 02:17:17	2010-12-15 02:20:23	M2QwYWYxZDZjYTg2ZWRiYWM3YTA4MDMyZjcxMDNjNTM=	yes	f
33	2	10	0	0	5	0	t	f	2010-12-15 02:17:18	2010-12-15 02:20:23	NzViMDFhOGVkMWFlMWFjYWI3OTVhOTVhYjJjMTUxZDk=	yes	f
\.


--
-- Data for Name: faq; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY faq (id, question, answer, order_seq, visible, created_at, updated_at) FROM stdin;
1	Como são calculados os <b>Pontos</b> do ranking?	A coluna <b>Pontos</b> exibida no ranking, e que pode ser um dos critérios de classificação é composta pela seguinte fórmula:<br/><br/>\n\t\t\t\t<b style="font-size: 10pt">(Média*Eventos*10)+(Eventos*10)</b><br/><br/>\n\n                <b>Exemplo:</b><br/>\n<table style="margin-top: 5px" cellspacing="1" cellpadding="0" border="0">\n    <tr><th>(A)</th><th align="right">Total B+R+A:</th><td>40,00</td></tr>\n    <tr><th>(B)</th><th align="right">Total prêmios:</th><td>55,00</td></tr>\n    <tr><th>(C)</th><th align="right">Balanço:</th><td>15,00 (B-A)</td></tr>\n    <tr><th>(D)</th><th align="right">Média:</th><td>1,375 (B/A)</td></tr>\n    <tr><th>(E)</th><th align="right">Eventos:</th><td>3</td></tr>\n    <tr><th>(F)</th><th align="right">Pontos:</th><td>71,25 (D*E*10)+(E*10)</td></tr>\n</table>\n                <br/><br/>Ou seja, quanto maior o a relação Ganhos/Gastos e quanto maior a quantidade de eventos que o jogador participa, maior será sua pontuação.	1	t	2010-11-26 01:54:44.100137	2010-11-26 01:54:44.100137
2	Posso mudar meu e-mail após o cadastro?	Sim! Mesmo quando você ainda não é cadastrado no site, seus amigos podem adicioná-lo aos eventos através de seu e-mail.<br/><br/>\nQuando você faz o cadastro utilizando esse mesmo, seu cadastro é automaticamente relacionado aos eventos aos quais você já foi incluído. A partir daí você pode alterar seu e-mail e continuará fazendo parte dos rankings e eventos já inscritos	2	t	2010-11-29 16:45:47.492282	2010-11-29 16:45:47.492282
\.


--
-- Data for Name: file; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY file (id, file_name, file_path, file_size, description, is_image, deleted, created_at, updated_at) FROM stdin;
18	emailTemplate.htm	templates/emailTemplate.htm	\N	Template padrão de e-mail	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
19	emailTemplateAdmin.htm	templates/emailTemplateAdmin.htm	\N	Template de e-mail para administração	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
20	signWelcome.htm	templates/signWelcome.htm	\N	E-mail de boas vindas	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
21	rankingPlayerAdd.htm	templates/rankingPlayerAdd.htm	\N	E-mail de notificação inclusão em ranking	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
22	eventCreateNotify.htm	templates/eventCreateNotify.htm	\N	E-mail de notificação de criação de evento	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
23	eventChangeNotify.htm	templates/eventChangeNotify.htm	\N	E-mail de notificação de alteração de evento	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
24	eventResult.htm	templates/eventResult.htm	\N	E-mail de notificação de resultado de evento	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
25	eventDeleteNotify.htm	templates/eventDeleteNotify.htm	\N	E-mail de notificação de exclusão de evento	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
26	newUserInvite.htm	templates/newUserInvite.htm	\N	Convite de cadastro para novos usuários	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
27	confirmPresenceNotify.htm	templates/confirmPresenceNotify.htm	\N	Notificação de confirmação de presença	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
28	eventReminder.htm	templates/eventReminder.htm	\N	Lembrete de evento	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
29	contactMessage.htm	templates/contactMessage.htm	\N	E-mail para notificação de contato	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
30	feedbackMessage.htm	templates/feedbackMessage.htm	\N	E-mail de contato para feedback	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
31	friendInvite.htm	templates/friendInvite.htm	\N	Convite para ingressar ao site	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
32	faqQuestion.htm	templates/faqQuestion.htm	\N	Nova dúvida do FAQ	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
33	eventCommentNotify.htm	templates/eventCommentNotify.htm	\N	Comentários no evento	f	f	2010-12-16 02:25:29.398157	2010-12-16 02:25:29.398157
\.


--
-- Data for Name: log; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY log (id, user_site_id, app, module_name, action_name, message, class_name, created_at, updated_at) FROM stdin;
1	1	frontend	ranking	toggleShare	Editou o registro 1 e 3 na tabela ranking_player	RankingPlayer	2010-12-10 15:39:58	2010-12-10 15:39:58
2	1	frontend	ranking	toggleShare	Editou o registro 1 e 2 na tabela ranking_player	RankingPlayer	2010-12-10 15:40:00	2010-12-10 15:40:00
3	1	frontend	ranking	toggleShare	Editou o registro 1 e 4 na tabela ranking_player	RankingPlayer	2010-12-10 15:40:06	2010-12-10 15:40:06
4	1	frontend	ranking	toggleShare	Editou o registro 1 e 6 na tabela ranking_player	RankingPlayer	2010-12-10 15:40:09	2010-12-10 15:40:09
5	2	frontend	ranking	savePlayer	Editou o registro 1 na tabela ranking	Ranking	2010-12-12 23:59:11	2010-12-12 23:59:11
6	2	frontend	ranking	savePlayer	Inseriu o registro 1 e 19 na tabela ranking_player	RankingPlayer	2010-12-12 23:59:11	2010-12-12 23:59:11
7	2	frontend	ranking	savePlayer	Inseriu o registro 24 e 19 na tabela event_player	EventPlayer	2010-12-12 23:59:11	2010-12-12 23:59:11
8	2	frontend	event	save	Editou o registro 1 na tabela ranking	Ranking	2010-12-13 00:17:29	2010-12-13 00:17:29
9	2	frontend	event	save	Inseriu o registro 30 e 8 na tabela event_player	EventPlayer	2010-12-13 00:17:29	2010-12-13 00:17:29
10	2	frontend	event	save	Inseriu o registro 30 e 9 na tabela event_player	EventPlayer	2010-12-13 00:17:29	2010-12-13 00:17:29
11	2	frontend	event	save	Inseriu o registro 30 e 3 na tabela event_player	EventPlayer	2010-12-13 00:17:29	2010-12-13 00:17:29
12	2	frontend	event	save	Inseriu o registro 30 e 10 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
13	2	frontend	event	save	Inseriu o registro 30 e 7 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
14	2	frontend	event	save	Inseriu o registro 30 e 19 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
15	2	frontend	event	save	Inseriu o registro 30 e 18 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
16	2	frontend	event	save	Inseriu o registro 30 e 5 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
17	2	frontend	event	save	Inseriu o registro 30 e 6 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
18	2	frontend	event	save	Inseriu o registro 30 e 1 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
19	2	frontend	event	save	Inseriu o registro 30 e 17 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
20	2	frontend	event	save	Inseriu o registro 30 e 11 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
21	2	frontend	event	save	Inseriu o registro 30 e 12 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
22	2	frontend	event	save	Inseriu o registro 30 e 4 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
23	2	frontend	event	save	Inseriu o registro 30 e 15 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
24	2	frontend	event	save	Inseriu o registro 30 e 14 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
25	2	frontend	event	save	Inseriu o registro 30 e 13 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
26	2	frontend	event	save	Inseriu o registro 30 e 2 na tabela event_player	EventPlayer	2010-12-13 00:17:30	2010-12-13 00:17:30
27	2	frontend	event	save	Inseriu o registro 30 na tabela event	Event	2010-12-13 00:17:30	2010-12-13 00:17:30
28	2	frontend	event	choosePresence	Editou o registro 30 na tabela event	Event	2010-12-13 00:17:34	2010-12-13 00:17:34
29	2	frontend	event	choosePresence	Editou o registro 30 e 2 na tabela event_player	EventPlayer	2010-12-13 00:17:34	2010-12-13 00:17:34
30	2	frontend	event	save	Editou o registro 30 na tabela event	Event	2010-12-13 00:19:51	2010-12-13 00:19:51
31	11	frontend	event	choosePresence	Editou o registro 30 na tabela event	Event	2010-12-13 08:37:29	2010-12-13 08:37:29
32	11	frontend	event	choosePresence	Editou o registro 30 e 17 na tabela event_player	EventPlayer	2010-12-13 08:37:29	2010-12-13 08:37:29
33	1	frontend	event	choosePresence	Editou o registro 30 na tabela event	Event	2010-12-13 09:11:40	2010-12-13 09:11:40
34	1	frontend	event	choosePresence	Editou o registro 30 e 1 na tabela event_player	EventPlayer	2010-12-13 09:11:40	2010-12-13 09:11:40
35	1	frontend	event	save	Editou o registro 30 na tabela event	Event	2010-12-13 09:11:59	2010-12-13 09:11:59
36	2	frontend	event	save	Editou o registro 30 na tabela event	Event	2010-12-13 17:46:55	2010-12-13 17:46:55
37	4	frontend	event	choosePresence	Editou o registro 30 na tabela event	Event	2010-12-14 10:44:11	2010-12-14 10:44:11
38	4	frontend	event	choosePresence	Editou o registro 30 e 4 na tabela event_player	EventPlayer	2010-12-14 10:44:11	2010-12-14 10:44:11
39	10	frontend	event	choosePresence	Editou o registro 24 na tabela event	Event	2010-12-14 17:36:54	2010-12-14 17:36:54
40	10	frontend	event	choosePresence	Editou o registro 24 e 9 na tabela event_player	EventPlayer	2010-12-14 17:36:54	2010-12-14 17:36:54
41	8	frontend	event	choosePresence	Editou o registro 30 na tabela event	Event	2010-12-14 17:46:37	2010-12-14 17:46:37
42	8	frontend	event	choosePresence	Editou o registro 30 e 7 na tabela event_player	EventPlayer	2010-12-14 17:46:37	2010-12-14 17:46:37
43	9	frontend	event	choosePresence	Editou o registro 24 na tabela event	Event	2010-12-14 17:59:46	2010-12-14 17:59:46
44	9	frontend	event	choosePresence	Editou o registro 24 e 3 na tabela event_player	EventPlayer	2010-12-14 17:59:46	2010-12-14 17:59:46
45	6	frontend	event	togglePresence	Editou o registro 24 na tabela event	Event	2010-12-14 18:11:45	2010-12-14 18:11:45
46	6	frontend	event	togglePresence	Editou o registro 24 e 6 na tabela event_player	EventPlayer	2010-12-14 18:11:45	2010-12-14 18:11:45
47	6	frontend	event	togglePresence	Editou o registro 24 na tabela event	Event	2010-12-14 18:13:28	2010-12-14 18:13:28
48	6	frontend	event	togglePresence	Editou o registro 24 e 6 na tabela event_player	EventPlayer	2010-12-14 18:13:28	2010-12-14 18:13:28
49	6	frontend	event	togglePresence	Editou o registro 24 na tabela event	Event	2010-12-14 18:13:45	2010-12-14 18:13:45
50	6	frontend	event	togglePresence	Editou o registro 24 e 6 na tabela event_player	EventPlayer	2010-12-14 18:13:45	2010-12-14 18:13:45
51	6	frontend	event	save	Editou o registro 24 e 8 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
52	6	frontend	event	save	Editou o registro 24 e 10 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
53	6	frontend	event	save	Editou o registro 24 e 7 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
54	6	frontend	event	save	Editou o registro 24 e 18 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
55	6	frontend	event	save	Editou o registro 24 e 5 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
56	6	frontend	event	save	Editou o registro 24 e 1 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
57	6	frontend	event	save	Editou o registro 24 e 17 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
58	6	frontend	event	save	Editou o registro 24 e 11 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
59	6	frontend	event	save	Editou o registro 24 e 12 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
60	6	frontend	event	save	Editou o registro 24 e 4 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
61	6	frontend	event	save	Editou o registro 24 e 15 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
62	6	frontend	event	save	Editou o registro 24 e 14 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
63	6	frontend	event	save	Editou o registro 24 e 13 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
64	6	frontend	event	save	Editou o registro 24 e 2 na tabela event_player	EventPlayer	2010-12-14 18:13:58	2010-12-14 18:13:58
65	6	frontend	event	save	Editou o registro 24 na tabela event	Event	2010-12-14 18:13:58	2010-12-14 18:13:58
66	2	frontend	ranking	savePlayer	Editou o registro 1 na tabela ranking	Ranking	2010-12-15 02:13:06	2010-12-15 02:13:06
67	2	frontend	ranking	savePlayer	Inseriu o registro 1 e 20 na tabela ranking_player	RankingPlayer	2010-12-15 02:13:06	2010-12-15 02:13:06
68	2	frontend	ranking	savePlayer	Inseriu o registro 24 e 20 na tabela event_player	EventPlayer	2010-12-15 02:13:06	2010-12-15 02:13:06
69	2	frontend	event	delete	Editou o registro 1 na tabela ranking	Ranking	2010-12-15 02:14:06	2010-12-15 02:14:06
70	2	frontend	event	delete	Editou o registro 30 na tabela event	Event	2010-12-15 02:14:06	2010-12-15 02:14:06
71	2	frontend	event	delete	Editou o registro 1 e 4 na tabela ranking_player	RankingPlayer	2010-12-15 02:14:06	2010-12-15 02:14:06
72	2	frontend	event	save	Editou o registro 1 na tabela ranking	Ranking	2010-12-15 02:17:17	2010-12-15 02:17:17
73	2	frontend	event	save	Inseriu o registro 33 e 8 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
74	2	frontend	event	save	Inseriu o registro 33 e 9 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
75	2	frontend	event	save	Inseriu o registro 33 e 3 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
76	2	frontend	event	save	Inseriu o registro 33 e 10 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
77	2	frontend	event	save	Inseriu o registro 33 e 7 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
78	2	frontend	event	save	Inseriu o registro 33 e 19 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
79	2	frontend	event	save	Inseriu o registro 33 e 20 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
80	2	frontend	event	save	Inseriu o registro 33 e 18 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
81	2	frontend	event	save	Inseriu o registro 33 e 5 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
82	2	frontend	event	save	Inseriu o registro 33 e 6 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
83	2	frontend	event	save	Inseriu o registro 33 e 1 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
84	2	frontend	event	save	Inseriu o registro 33 e 17 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
85	2	frontend	event	save	Inseriu o registro 33 e 11 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
86	2	frontend	event	save	Inseriu o registro 33 e 12 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
87	2	frontend	event	save	Inseriu o registro 33 e 4 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
88	2	frontend	event	save	Inseriu o registro 33 e 15 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
89	2	frontend	event	save	Inseriu o registro 33 e 14 na tabela event_player	EventPlayer	2010-12-15 02:17:17	2010-12-15 02:17:17
90	2	frontend	event	save	Inseriu o registro 33 e 13 na tabela event_player	EventPlayer	2010-12-15 02:17:18	2010-12-15 02:17:18
91	2	frontend	event	save	Inseriu o registro 33 e 2 na tabela event_player	EventPlayer	2010-12-15 02:17:18	2010-12-15 02:17:18
92	2	frontend	event	save	Inseriu o registro 33 na tabela event	Event	2010-12-15 02:17:18	2010-12-15 02:17:18
93	2	frontend	event	cloneEvent	Inseriu o registro 34 e 8 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
94	2	frontend	event	cloneEvent	Inseriu o registro 34 e 9 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
95	2	frontend	event	cloneEvent	Inseriu o registro 34 e 3 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
96	2	frontend	event	cloneEvent	Inseriu o registro 34 e 10 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
97	2	frontend	event	cloneEvent	Inseriu o registro 34 e 7 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
98	2	frontend	event	cloneEvent	Inseriu o registro 34 e 19 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
99	2	frontend	event	cloneEvent	Inseriu o registro 34 e 20 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
100	2	frontend	event	cloneEvent	Inseriu o registro 34 e 18 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
101	2	frontend	event	cloneEvent	Inseriu o registro 34 e 5 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
102	2	frontend	event	cloneEvent	Inseriu o registro 34 e 6 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
103	2	frontend	event	cloneEvent	Inseriu o registro 34 e 1 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
104	2	frontend	event	cloneEvent	Inseriu o registro 34 e 17 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
105	2	frontend	event	cloneEvent	Inseriu o registro 34 e 11 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
106	2	frontend	event	cloneEvent	Inseriu o registro 34 e 12 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
107	2	frontend	event	cloneEvent	Inseriu o registro 34 e 4 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
108	2	frontend	event	cloneEvent	Inseriu o registro 34 e 15 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
109	2	frontend	event	cloneEvent	Inseriu o registro 34 e 14 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
110	2	frontend	event	cloneEvent	Inseriu o registro 34 e 13 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
111	2	frontend	event	cloneEvent	Inseriu o registro 34 e 2 na tabela event_player	EventPlayer	2010-12-15 02:17:51	2010-12-15 02:17:51
112	2	frontend	event	save	Editou o registro 1 na tabela ranking	Ranking	2010-12-15 02:18:09	2010-12-15 02:18:09
113	2	frontend	event	save	Editou o registro 34 e 8 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
114	2	frontend	event	save	Editou o registro 34 e 9 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
115	2	frontend	event	save	Editou o registro 34 e 3 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
116	2	frontend	event	save	Editou o registro 34 e 10 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
117	2	frontend	event	save	Editou o registro 34 e 7 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
118	2	frontend	event	save	Editou o registro 34 e 19 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
119	2	frontend	event	save	Editou o registro 34 e 20 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
120	2	frontend	event	save	Editou o registro 34 e 18 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
121	2	frontend	event	save	Editou o registro 34 e 5 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
122	2	frontend	event	save	Editou o registro 34 e 6 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
123	2	frontend	event	save	Editou o registro 34 e 1 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
124	2	frontend	event	save	Editou o registro 34 e 17 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
125	2	frontend	event	save	Editou o registro 34 e 11 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
126	2	frontend	event	save	Editou o registro 34 e 12 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
127	2	frontend	event	save	Editou o registro 34 e 4 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
128	2	frontend	event	save	Editou o registro 34 e 15 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
129	2	frontend	event	save	Editou o registro 34 e 14 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
130	2	frontend	event	save	Editou o registro 34 e 13 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
131	2	frontend	event	save	Editou o registro 34 e 2 na tabela event_player	EventPlayer	2010-12-15 02:18:09	2010-12-15 02:18:09
132	2	frontend	event	save	Inseriu o registro 34 na tabela event	Event	2010-12-15 02:18:09	2010-12-15 02:18:09
133	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
134	2	frontend	event	saveResult	Editou o registro 33 e 7 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
135	2	frontend	event	saveResult	Editou o registro 33 e 7 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
136	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
137	2	frontend	event	saveResult	Editou o registro 33 e 20 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
138	2	frontend	event	saveResult	Editou o registro 33 e 20 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
139	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
140	2	frontend	event	saveResult	Editou o registro 33 e 1 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
141	2	frontend	event	saveResult	Editou o registro 33 e 1 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
142	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
143	2	frontend	event	saveResult	Editou o registro 33 e 17 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
144	2	frontend	event	saveResult	Editou o registro 33 e 17 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
145	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
146	2	frontend	event	saveResult	Editou o registro 33 e 4 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
147	2	frontend	event	saveResult	Editou o registro 33 e 4 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
148	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
149	2	frontend	event	saveResult	Editou o registro 33 e 2 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
150	2	frontend	event	saveResult	Editou o registro 33 e 2 na tabela event_player	EventPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
151	2	frontend	event	saveResult	Editou o registro 33 na tabela event	Event	2010-12-15 02:20:23	2010-12-15 02:20:23
152	2	frontend	event	saveResult	Editou o registro 1 e 7 na tabela ranking_player	RankingPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
153	2	frontend	event	saveResult	Editou o registro 1 e 20 na tabela ranking_player	RankingPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
154	2	frontend	event	saveResult	Editou o registro 1 e 1 na tabela ranking_player	RankingPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
155	2	frontend	event	saveResult	Editou o registro 1 e 17 na tabela ranking_player	RankingPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
156	2	frontend	event	saveResult	Editou o registro 1 e 4 na tabela ranking_player	RankingPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
157	2	frontend	event	saveResult	Editou o registro 1 e 2 na tabela ranking_player	RankingPlayer	2010-12-15 02:20:23	2010-12-15 02:20:23
158	2	frontend	event	saveResult	Inseriu o registro 1 e 8 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
159	2	frontend	event	saveResult	Inseriu o registro 1 e 9 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
160	2	frontend	event	saveResult	Inseriu o registro 1 e 3 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
161	2	frontend	event	saveResult	Inseriu o registro 1 e 10 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
162	2	frontend	event	saveResult	Inseriu o registro 1 e 7 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
163	2	frontend	event	saveResult	Inseriu o registro 1 e 19 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
164	2	frontend	event	saveResult	Inseriu o registro 1 e 20 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
165	2	frontend	event	saveResult	Inseriu o registro 1 e 18 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
166	2	frontend	event	saveResult	Inseriu o registro 1 e 5 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:23	2010-12-15 02:20:23
167	2	frontend	event	saveResult	Inseriu o registro 1 e 6 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
168	2	frontend	event	saveResult	Inseriu o registro 1 e 1 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
169	2	frontend	event	saveResult	Inseriu o registro 1 e 17 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
170	2	frontend	event	saveResult	Inseriu o registro 1 e 11 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
171	2	frontend	event	saveResult	Inseriu o registro 1 e 12 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
172	2	frontend	event	saveResult	Inseriu o registro 1 e 4 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
173	2	frontend	event	saveResult	Inseriu o registro 1 e 15 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
174	2	frontend	event	saveResult	Inseriu o registro 1 e 14 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
175	2	frontend	event	saveResult	Inseriu o registro 1 e 13 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
176	2	frontend	event	saveResult	Inseriu o registro 1 e 2 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
177	2	frontend	event	saveResult	Editou o registro 1 e 2 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
178	2	frontend	event	saveResult	Editou o registro 1 e 3 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
179	2	frontend	event	saveResult	Editou o registro 1 e 6 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
180	2	frontend	event	saveResult	Editou o registro 1 e 1 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
181	2	frontend	event	saveResult	Editou o registro 1 e 4 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
182	2	frontend	event	saveResult	Editou o registro 1 e 5 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
183	2	frontend	event	saveResult	Editou o registro 1 e 7 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
184	2	frontend	event	saveResult	Editou o registro 1 e 15 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
185	2	frontend	event	saveResult	Editou o registro 1 e 14 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
186	2	frontend	event	saveResult	Editou o registro 1 e 17 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
187	2	frontend	event	saveResult	Editou o registro 1 e 9 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
188	2	frontend	event	saveResult	Editou o registro 1 e 20 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
189	2	frontend	event	saveResult	Editou o registro 1 e 11 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
190	2	frontend	event	saveResult	Editou o registro 1 e 12 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
191	2	frontend	event	saveResult	Editou o registro 1 e 13 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
192	2	frontend	event	saveResult	Editou o registro 1 e 8 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
193	2	frontend	event	saveResult	Editou o registro 1 e 10 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
194	2	frontend	event	saveResult	Editou o registro 1 e 18 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
195	2	frontend	event	saveResult	Editou o registro 1 e 19 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
196	2	frontend	event	saveResult	Editou o registro 1 e 17 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
197	2	frontend	event	saveResult	Editou o registro 1 e 20 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
198	2	frontend	event	saveResult	Editou o registro 1 e 2 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
199	2	frontend	event	saveResult	Editou o registro 1 e 4 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
200	2	frontend	event	saveResult	Editou o registro 1 e 1 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
201	2	frontend	event	saveResult	Editou o registro 1 e 7 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
202	2	frontend	event	saveResult	Editou o registro 1 e 6 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
203	2	frontend	event	saveResult	Editou o registro 1 e 3 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
204	2	frontend	event	saveResult	Editou o registro 1 e 15 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
205	2	frontend	event	saveResult	Editou o registro 1 e 5 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
206	2	frontend	event	saveResult	Editou o registro 1 e 14 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
207	2	frontend	event	saveResult	Editou o registro 1 e 18 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
208	2	frontend	event	saveResult	Editou o registro 1 e 19 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
209	2	frontend	event	saveResult	Editou o registro 1 e 8 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
210	2	frontend	event	saveResult	Editou o registro 1 e 10 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
211	2	frontend	event	saveResult	Editou o registro 1 e 11 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
212	2	frontend	event	saveResult	Editou o registro 1 e 12 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
213	2	frontend	event	saveResult	Editou o registro 1 e 13 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
214	2	frontend	event	saveResult	Editou o registro 1 e 9 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:20:24	2010-12-15 02:20:24
215	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:14	2010-12-15 02:22:14
216	2	frontend	event	saveResult	Editou o registro 34 e 7 na tabela event_player	EventPlayer	2010-12-15 02:22:14	2010-12-15 02:22:14
217	2	frontend	event	saveResult	Editou o registro 34 e 7 na tabela event_player	EventPlayer	2010-12-15 02:22:14	2010-12-15 02:22:14
218	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:14	2010-12-15 02:22:14
219	2	frontend	event	saveResult	Editou o registro 34 e 20 na tabela event_player	EventPlayer	2010-12-15 02:22:14	2010-12-15 02:22:14
220	2	frontend	event	saveResult	Editou o registro 34 e 20 na tabela event_player	EventPlayer	2010-12-15 02:22:14	2010-12-15 02:22:14
221	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:14	2010-12-15 02:22:14
222	2	frontend	event	saveResult	Editou o registro 34 e 1 na tabela event_player	EventPlayer	2010-12-15 02:22:14	2010-12-15 02:22:14
223	2	frontend	event	saveResult	Editou o registro 34 e 1 na tabela event_player	EventPlayer	2010-12-15 02:22:14	2010-12-15 02:22:14
224	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:15	2010-12-15 02:22:15
225	2	frontend	event	saveResult	Editou o registro 34 e 17 na tabela event_player	EventPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
226	2	frontend	event	saveResult	Editou o registro 34 e 17 na tabela event_player	EventPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
227	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:15	2010-12-15 02:22:15
228	2	frontend	event	saveResult	Editou o registro 34 e 4 na tabela event_player	EventPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
229	2	frontend	event	saveResult	Editou o registro 34 e 4 na tabela event_player	EventPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
230	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:15	2010-12-15 02:22:15
231	2	frontend	event	saveResult	Editou o registro 34 e 2 na tabela event_player	EventPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
232	2	frontend	event	saveResult	Editou o registro 34 e 2 na tabela event_player	EventPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
233	2	frontend	event	saveResult	Editou o registro 34 na tabela event	Event	2010-12-15 02:22:15	2010-12-15 02:22:15
234	2	frontend	event	saveResult	Editou o registro 1 e 7 na tabela ranking_player	RankingPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
235	2	frontend	event	saveResult	Editou o registro 1 e 20 na tabela ranking_player	RankingPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
236	2	frontend	event	saveResult	Editou o registro 1 e 1 na tabela ranking_player	RankingPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
237	2	frontend	event	saveResult	Editou o registro 1 e 17 na tabela ranking_player	RankingPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
238	2	frontend	event	saveResult	Editou o registro 1 e 4 na tabela ranking_player	RankingPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
239	2	frontend	event	saveResult	Editou o registro 1 e 2 na tabela ranking_player	RankingPlayer	2010-12-15 02:22:15	2010-12-15 02:22:15
240	2	frontend	event	saveResult	Inseriu o registro 1 e 8 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
241	2	frontend	event	saveResult	Inseriu o registro 1 e 9 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
242	2	frontend	event	saveResult	Inseriu o registro 1 e 3 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
243	2	frontend	event	saveResult	Inseriu o registro 1 e 10 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
244	2	frontend	event	saveResult	Inseriu o registro 1 e 7 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
245	2	frontend	event	saveResult	Inseriu o registro 1 e 19 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
246	2	frontend	event	saveResult	Inseriu o registro 1 e 20 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
247	2	frontend	event	saveResult	Inseriu o registro 1 e 18 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
248	2	frontend	event	saveResult	Inseriu o registro 1 e 5 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
249	2	frontend	event	saveResult	Inseriu o registro 1 e 6 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
250	2	frontend	event	saveResult	Inseriu o registro 1 e 1 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
251	2	frontend	event	saveResult	Inseriu o registro 1 e 17 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
252	2	frontend	event	saveResult	Inseriu o registro 1 e 11 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
253	2	frontend	event	saveResult	Inseriu o registro 1 e 12 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
254	2	frontend	event	saveResult	Inseriu o registro 1 e 4 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
255	2	frontend	event	saveResult	Inseriu o registro 1 e 15 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
256	2	frontend	event	saveResult	Inseriu o registro 1 e 14 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
257	2	frontend	event	saveResult	Inseriu o registro 1 e 13 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
258	2	frontend	event	saveResult	Inseriu o registro 1 e 2 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
259	2	frontend	event	saveResult	Editou o registro 1 e 2 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
260	2	frontend	event	saveResult	Editou o registro 1 e 3 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
261	2	frontend	event	saveResult	Editou o registro 1 e 6 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
262	2	frontend	event	saveResult	Editou o registro 1 e 1 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
263	2	frontend	event	saveResult	Editou o registro 1 e 4 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
264	2	frontend	event	saveResult	Editou o registro 1 e 5 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
265	2	frontend	event	saveResult	Editou o registro 1 e 7 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
266	2	frontend	event	saveResult	Editou o registro 1 e 15 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
267	2	frontend	event	saveResult	Editou o registro 1 e 14 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
268	2	frontend	event	saveResult	Editou o registro 1 e 20 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
269	2	frontend	event	saveResult	Editou o registro 1 e 17 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
270	2	frontend	event	saveResult	Editou o registro 1 e 9 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
271	2	frontend	event	saveResult	Editou o registro 1 e 11 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
272	2	frontend	event	saveResult	Editou o registro 1 e 12 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
273	2	frontend	event	saveResult	Editou o registro 1 e 13 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
274	2	frontend	event	saveResult	Editou o registro 1 e 8 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
275	2	frontend	event	saveResult	Editou o registro 1 e 10 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
276	2	frontend	event	saveResult	Editou o registro 1 e 18 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
277	2	frontend	event	saveResult	Editou o registro 1 e 19 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
278	2	frontend	event	saveResult	Editou o registro 1 e 2 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
302	1	frontend	event	save	Editou o registro 24 na tabela event	Event	2010-12-16 03:10:48	2010-12-16 03:10:48
279	2	frontend	event	saveResult	Editou o registro 1 e 20 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
280	2	frontend	event	saveResult	Editou o registro 1 e 17 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
281	2	frontend	event	saveResult	Editou o registro 1 e 7 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
282	2	frontend	event	saveResult	Editou o registro 1 e 4 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
283	2	frontend	event	saveResult	Editou o registro 1 e 1 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
284	2	frontend	event	saveResult	Editou o registro 1 e 6 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
285	2	frontend	event	saveResult	Editou o registro 1 e 3 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
286	2	frontend	event	saveResult	Editou o registro 1 e 15 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
287	2	frontend	event	saveResult	Editou o registro 1 e 5 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
288	2	frontend	event	saveResult	Editou o registro 1 e 14 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
289	2	frontend	event	saveResult	Editou o registro 1 e 18 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:15	2010-12-15 02:22:15
290	2	frontend	event	saveResult	Editou o registro 1 e 19 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
291	2	frontend	event	saveResult	Editou o registro 1 e 8 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
292	2	frontend	event	saveResult	Editou o registro 1 e 10 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
293	2	frontend	event	saveResult	Editou o registro 1 e 11 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
294	2	frontend	event	saveResult	Editou o registro 1 e 12 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
295	2	frontend	event	saveResult	Editou o registro 1 e 13 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
296	2	frontend	event	saveResult	Editou o registro 1 e 9 e 2010-12-14 na tabela ranking_history	RankingHistory	2010-12-15 02:22:16	2010-12-15 02:22:16
297	2	frontend	ranking	toggleShare	Editou o registro 1 e 14 na tabela ranking_player	RankingPlayer	2010-12-15 12:14:37	2010-12-15 12:14:37
298	2	frontend	ranking	toggleShare	Editou o registro 1 e 14 na tabela ranking_player	RankingPlayer	2010-12-15 12:14:47	2010-12-15 12:14:47
299	2	frontend	ranking	toggleShare	Editou o registro 1 e 6 na tabela ranking_player	RankingPlayer	2010-12-15 12:16:24	2010-12-15 12:16:24
300	2	frontend	ranking	toggleShare	Editou o registro 1 e 4 na tabela ranking_player	RankingPlayer	2010-12-15 12:16:40	2010-12-15 12:16:40
301	1	frontend	event	saveComment	Inseriu o registro 1 na tabela event_comment	EventComment	2010-12-16 03:10:21	2010-12-16 03:10:21
303	6	frontend	event	saveComment	Inseriu o registro 2 na tabela event_comment	EventComment	2010-12-16 08:10:20	2010-12-16 08:10:20
304	4	frontend	event	saveComment	Inseriu o registro 3 na tabela event_comment	EventComment	2010-12-16 10:14:52	2010-12-16 10:14:52
\.


--
-- Data for Name: log_field; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY log_field (log_id, field_name, field_value, created_at, updated_at) FROM stdin;
1	ALLOW_EDIT	Sim	2010-12-10 15:39:58.38545	2010-12-10 15:39:58.38545
2	ALLOW_EDIT	Sim	2010-12-10 15:40:00.882119	2010-12-10 15:40:00.882119
3	ALLOW_EDIT	Sim	2010-12-10 15:40:06.404101	2010-12-10 15:40:06.404101
4	ALLOW_EDIT	Sim	2010-12-10 15:40:09.771407	2010-12-10 15:40:09.771407
5	PLAYERS	18	2010-12-12 23:59:11.620685	2010-12-12 23:59:11.620685
6	RANKING_ID	1	2010-12-12 23:59:11.634967	2010-12-12 23:59:11.634967
6	PEOPLE_ID	19	2010-12-12 23:59:11.634967	2010-12-12 23:59:11.634967
6	TOTAL_PAID	0	2010-12-12 23:59:11.634967	2010-12-12 23:59:11.634967
6	TOTAL_PRIZE	0	2010-12-12 23:59:11.634967	2010-12-12 23:59:11.634967
6	TOTAL_BALANCE	0	2010-12-12 23:59:11.634967	2010-12-12 23:59:11.634967
6	ENABLED	Sim	2010-12-12 23:59:11.634967	2010-12-12 23:59:11.634967
7	EVENT_ID	24	2010-12-12 23:59:11.676889	2010-12-12 23:59:11.676889
7	PEOPLE_ID	19	2010-12-12 23:59:11.676889	2010-12-12 23:59:11.676889
7	CONFIRM_CODE	YzRhMmYxZDI5MDc3YzgxNGNkYWRmNTE5OTljMGVjZWE=	2010-12-12 23:59:11.676889	2010-12-12 23:59:11.676889
7	INVITE_STATUS	none	2010-12-12 23:59:11.676889	2010-12-12 23:59:11.676889
7	DELETED	Não	2010-12-12 23:59:11.676889	2010-12-12 23:59:11.676889
8	EVENTS	19	2010-12-13 00:17:29.946206	2010-12-13 00:17:29.946206
9	EVENT_ID	30	2010-12-13 00:17:29.975759	2010-12-13 00:17:29.975759
9	PEOPLE_ID	8	2010-12-13 00:17:29.975759	2010-12-13 00:17:29.975759
9	CONFIRM_CODE	YzE0M2U1MWIwMDYwYjlkYzdlYWUzNmRmZDQyMDBlMzI=	2010-12-13 00:17:29.975759	2010-12-13 00:17:29.975759
9	INVITE_STATUS	none	2010-12-13 00:17:29.975759	2010-12-13 00:17:29.975759
9	DELETED	Não	2010-12-13 00:17:29.975759	2010-12-13 00:17:29.975759
10	EVENT_ID	30	2010-12-13 00:17:29.99119	2010-12-13 00:17:29.99119
10	PEOPLE_ID	9	2010-12-13 00:17:29.99119	2010-12-13 00:17:29.99119
10	CONFIRM_CODE	ZjljOWUxYzVkZjU2ZWEyNmYxZWRmOTQ5YTVhZTJhZTU=	2010-12-13 00:17:29.99119	2010-12-13 00:17:29.99119
10	INVITE_STATUS	none	2010-12-13 00:17:29.99119	2010-12-13 00:17:29.99119
10	DELETED	Não	2010-12-13 00:17:29.99119	2010-12-13 00:17:29.99119
11	EVENT_ID	30	2010-12-13 00:17:29.999721	2010-12-13 00:17:29.999721
11	PEOPLE_ID	3	2010-12-13 00:17:29.999721	2010-12-13 00:17:29.999721
11	CONFIRM_CODE	YTliODgwZGEyZGY3NTE0ZjE2MmJkZTA3ZWJlYTkzYTY=	2010-12-13 00:17:29.999721	2010-12-13 00:17:29.999721
11	INVITE_STATUS	none	2010-12-13 00:17:29.999721	2010-12-13 00:17:29.999721
11	DELETED	Não	2010-12-13 00:17:29.999721	2010-12-13 00:17:29.999721
12	EVENT_ID	30	2010-12-13 00:17:30.019036	2010-12-13 00:17:30.019036
12	PEOPLE_ID	10	2010-12-13 00:17:30.019036	2010-12-13 00:17:30.019036
12	CONFIRM_CODE	OWU3Nzc5MWQwMmFjNWY4YWVjZDQ5ZDgyNzY1MGRkNGU=	2010-12-13 00:17:30.019036	2010-12-13 00:17:30.019036
12	INVITE_STATUS	none	2010-12-13 00:17:30.019036	2010-12-13 00:17:30.019036
12	DELETED	Não	2010-12-13 00:17:30.019036	2010-12-13 00:17:30.019036
13	EVENT_ID	30	2010-12-13 00:17:30.04626	2010-12-13 00:17:30.04626
13	PEOPLE_ID	7	2010-12-13 00:17:30.04626	2010-12-13 00:17:30.04626
13	CONFIRM_CODE	OGQzNmVjYTE0NzA2OTM0ODg0MWZmMDg1MzZkMDBjNjY=	2010-12-13 00:17:30.04626	2010-12-13 00:17:30.04626
13	INVITE_STATUS	none	2010-12-13 00:17:30.04626	2010-12-13 00:17:30.04626
13	DELETED	Não	2010-12-13 00:17:30.04626	2010-12-13 00:17:30.04626
14	EVENT_ID	30	2010-12-13 00:17:30.069628	2010-12-13 00:17:30.069628
14	PEOPLE_ID	19	2010-12-13 00:17:30.069628	2010-12-13 00:17:30.069628
14	CONFIRM_CODE	NDk4YzE2ZmE1MmVlYjBhMGJjYmM3Yjg4NDRmZjc4M2E=	2010-12-13 00:17:30.069628	2010-12-13 00:17:30.069628
14	INVITE_STATUS	none	2010-12-13 00:17:30.069628	2010-12-13 00:17:30.069628
14	DELETED	Não	2010-12-13 00:17:30.069628	2010-12-13 00:17:30.069628
15	EVENT_ID	30	2010-12-13 00:17:30.078142	2010-12-13 00:17:30.078142
15	PEOPLE_ID	18	2010-12-13 00:17:30.078142	2010-12-13 00:17:30.078142
15	CONFIRM_CODE	Y2MzOGQ2NTI5OTA5ZWIyNDM4ZjhiZTVhNTllNmY2YWQ=	2010-12-13 00:17:30.078142	2010-12-13 00:17:30.078142
15	INVITE_STATUS	none	2010-12-13 00:17:30.078142	2010-12-13 00:17:30.078142
15	DELETED	Não	2010-12-13 00:17:30.078142	2010-12-13 00:17:30.078142
16	EVENT_ID	30	2010-12-13 00:17:30.093543	2010-12-13 00:17:30.093543
16	PEOPLE_ID	5	2010-12-13 00:17:30.093543	2010-12-13 00:17:30.093543
16	CONFIRM_CODE	M2JmZWI4OWM2Y2EzZjE0MWYxNWUxZDc4YjA1OTdkOGI=	2010-12-13 00:17:30.093543	2010-12-13 00:17:30.093543
16	INVITE_STATUS	none	2010-12-13 00:17:30.093543	2010-12-13 00:17:30.093543
16	DELETED	Não	2010-12-13 00:17:30.093543	2010-12-13 00:17:30.093543
17	EVENT_ID	30	2010-12-13 00:17:30.103936	2010-12-13 00:17:30.103936
17	PEOPLE_ID	6	2010-12-13 00:17:30.103936	2010-12-13 00:17:30.103936
17	CONFIRM_CODE	MDIxYmY3NDY3NTdkOTdjNjdlMWUxMGQ4NjZiZjNhZDA=	2010-12-13 00:17:30.103936	2010-12-13 00:17:30.103936
17	INVITE_STATUS	none	2010-12-13 00:17:30.103936	2010-12-13 00:17:30.103936
17	DELETED	Não	2010-12-13 00:17:30.103936	2010-12-13 00:17:30.103936
18	EVENT_ID	30	2010-12-13 00:17:30.124394	2010-12-13 00:17:30.124394
18	PEOPLE_ID	1	2010-12-13 00:17:30.124394	2010-12-13 00:17:30.124394
18	CONFIRM_CODE	ODZjYmFlYzliMGEzM2QwMmMxOWFjMWI4MTM0OGY4NTY=	2010-12-13 00:17:30.124394	2010-12-13 00:17:30.124394
18	INVITE_STATUS	none	2010-12-13 00:17:30.124394	2010-12-13 00:17:30.124394
18	DELETED	Não	2010-12-13 00:17:30.124394	2010-12-13 00:17:30.124394
19	EVENT_ID	30	2010-12-13 00:17:30.137068	2010-12-13 00:17:30.137068
19	PEOPLE_ID	17	2010-12-13 00:17:30.137068	2010-12-13 00:17:30.137068
19	CONFIRM_CODE	OTA1ZTIxZmFkNzYwYTk0OTY5N2JmODJkNjM4MWVjZDI=	2010-12-13 00:17:30.137068	2010-12-13 00:17:30.137068
19	INVITE_STATUS	none	2010-12-13 00:17:30.137068	2010-12-13 00:17:30.137068
19	DELETED	Não	2010-12-13 00:17:30.137068	2010-12-13 00:17:30.137068
20	EVENT_ID	30	2010-12-13 00:17:30.155002	2010-12-13 00:17:30.155002
20	PEOPLE_ID	11	2010-12-13 00:17:30.155002	2010-12-13 00:17:30.155002
20	CONFIRM_CODE	NjAxNTQ2N2Q0MWI2YzNjNzk0YTE5ZGRkYmRhM2I3NDQ=	2010-12-13 00:17:30.155002	2010-12-13 00:17:30.155002
20	INVITE_STATUS	none	2010-12-13 00:17:30.155002	2010-12-13 00:17:30.155002
20	DELETED	Não	2010-12-13 00:17:30.155002	2010-12-13 00:17:30.155002
21	EVENT_ID	30	2010-12-13 00:17:30.178173	2010-12-13 00:17:30.178173
21	PEOPLE_ID	12	2010-12-13 00:17:30.178173	2010-12-13 00:17:30.178173
21	CONFIRM_CODE	ZDE0NzRkMTdlYzE3NGMyNGMxYThlOTBiZGUyZjY0Y2U=	2010-12-13 00:17:30.178173	2010-12-13 00:17:30.178173
21	INVITE_STATUS	none	2010-12-13 00:17:30.178173	2010-12-13 00:17:30.178173
21	DELETED	Não	2010-12-13 00:17:30.178173	2010-12-13 00:17:30.178173
22	EVENT_ID	30	2010-12-13 00:17:30.204168	2010-12-13 00:17:30.204168
22	PEOPLE_ID	4	2010-12-13 00:17:30.204168	2010-12-13 00:17:30.204168
22	CONFIRM_CODE	ODNjODRkZmQ3NzhjOTUzOTE5MDc5ZWMwYzUwMDZlMTY=	2010-12-13 00:17:30.204168	2010-12-13 00:17:30.204168
22	INVITE_STATUS	none	2010-12-13 00:17:30.204168	2010-12-13 00:17:30.204168
22	DELETED	Não	2010-12-13 00:17:30.204168	2010-12-13 00:17:30.204168
23	EVENT_ID	30	2010-12-13 00:17:30.229644	2010-12-13 00:17:30.229644
23	PEOPLE_ID	15	2010-12-13 00:17:30.229644	2010-12-13 00:17:30.229644
23	CONFIRM_CODE	MDNlNTRhOGI2ZGU0ZGQ2OTg4OTkwN2JkZGIxYzE5NDI=	2010-12-13 00:17:30.229644	2010-12-13 00:17:30.229644
23	INVITE_STATUS	none	2010-12-13 00:17:30.229644	2010-12-13 00:17:30.229644
23	DELETED	Não	2010-12-13 00:17:30.229644	2010-12-13 00:17:30.229644
24	EVENT_ID	30	2010-12-13 00:17:30.261349	2010-12-13 00:17:30.261349
24	PEOPLE_ID	14	2010-12-13 00:17:30.261349	2010-12-13 00:17:30.261349
24	CONFIRM_CODE	MGVkNDVjN2M4MDliZWU2YWZiZGU0NjZhMTk3N2ZlNmU=	2010-12-13 00:17:30.261349	2010-12-13 00:17:30.261349
24	INVITE_STATUS	none	2010-12-13 00:17:30.261349	2010-12-13 00:17:30.261349
24	DELETED	Não	2010-12-13 00:17:30.261349	2010-12-13 00:17:30.261349
25	EVENT_ID	30	2010-12-13 00:17:30.289616	2010-12-13 00:17:30.289616
25	PEOPLE_ID	13	2010-12-13 00:17:30.289616	2010-12-13 00:17:30.289616
25	CONFIRM_CODE	MjA3M2ZkNTZmNWFmYzUyZDIyMWM4MGU5ZGY5OGQ5NzE=	2010-12-13 00:17:30.289616	2010-12-13 00:17:30.289616
25	INVITE_STATUS	none	2010-12-13 00:17:30.289616	2010-12-13 00:17:30.289616
25	DELETED	Não	2010-12-13 00:17:30.289616	2010-12-13 00:17:30.289616
26	EVENT_ID	30	2010-12-13 00:17:30.314108	2010-12-13 00:17:30.314108
26	PEOPLE_ID	2	2010-12-13 00:17:30.314108	2010-12-13 00:17:30.314108
26	CONFIRM_CODE	YjNlNWNlYTgzZjY4NmU4OGJhOTlmYmFjNTliNWIyNDI=	2010-12-13 00:17:30.314108	2010-12-13 00:17:30.314108
26	INVITE_STATUS	none	2010-12-13 00:17:30.314108	2010-12-13 00:17:30.314108
26	DELETED	Não	2010-12-13 00:17:30.314108	2010-12-13 00:17:30.314108
27	RANKING_ID	1	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	EVENT_NAME	Sig & Go NLHE #1	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	EVENT_PLACE	AP do Wagner	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	BUYIN	10	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	PAID_PLACES	2	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	EVENT_DATE	2010-12-14	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	START_TIME	20:00:00	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	COMMENTS	paga 3 posição se tiver mais que 10 buy-in´s	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	INVITES	18	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	ENABLED	Sim	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
27	VISIBLE	Sim	2010-12-13 00:17:30.343378	2010-12-13 00:17:30.343378
28	PLAYERS	1	2010-12-13 00:17:34.556428	2010-12-13 00:17:34.556428
29	INVITE_STATUS	yes	2010-12-13 00:17:34.562271	2010-12-13 00:17:34.562271
29	ENABLED	Sim	2010-12-13 00:17:34.562271	2010-12-13 00:17:34.562271
30	EVENT_NAME	Sig & Go - NLHE #1	2010-12-13 00:19:51.440717	2010-12-13 00:19:51.440717
31	PLAYERS	2	2010-12-13 08:37:29.241831	2010-12-13 08:37:29.241831
32	INVITE_STATUS	yes	2010-12-13 08:37:29.261051	2010-12-13 08:37:29.261051
32	ENABLED	Sim	2010-12-13 08:37:29.261051	2010-12-13 08:37:29.261051
33	PLAYERS	3	2010-12-13 09:11:40.234342	2010-12-13 09:11:40.234342
34	INVITE_STATUS	yes	2010-12-13 09:11:40.245016	2010-12-13 09:11:40.245016
34	ENABLED	Sim	2010-12-13 09:11:40.245016	2010-12-13 09:11:40.245016
35	COMMENTS	paga 3 posição se tiver mais que 10 buy-ins\n\n(esqueceram de notificar o evento)	2010-12-13 09:11:59.769152	2010-12-13 09:11:59.769152
35	SENT_EMAIL	Sim	2010-12-13 09:11:59.769152	2010-12-13 09:11:59.769152
36	COMMENTS	paga 3 posições se tiver mais que 10 buy-ins	2010-12-13 17:46:55.59748	2010-12-13 17:46:55.59748
37	PLAYERS	4	2010-12-14 10:44:11.169608	2010-12-14 10:44:11.169608
38	INVITE_STATUS	yes	2010-12-14 10:44:11.190014	2010-12-14 10:44:11.190014
38	ENABLED	Sim	2010-12-14 10:44:11.190014	2010-12-14 10:44:11.190014
39	PLAYERS	5	2010-12-14 17:36:54.157811	2010-12-14 17:36:54.157811
40	CONFIRM_CODE	ZmY3ZTRlYzUzZjhjNmFlNWI5ZTM0NDRkMjRmY2QxYjI=	2010-12-14 17:36:54.171505	2010-12-14 17:36:54.171505
40	INVITE_STATUS	yes	2010-12-14 17:36:54.171505	2010-12-14 17:36:54.171505
40	ENABLED	Sim	2010-12-14 17:36:54.171505	2010-12-14 17:36:54.171505
41	PLAYERS	5	2010-12-14 17:46:37.556362	2010-12-14 17:46:37.556362
42	INVITE_STATUS	yes	2010-12-14 17:46:37.588026	2010-12-14 17:46:37.588026
42	ENABLED	Sim	2010-12-14 17:46:37.588026	2010-12-14 17:46:37.588026
43	PLAYERS	6	2010-12-14 17:59:46.877117	2010-12-14 17:59:46.877117
44	CONFIRM_CODE	NTlmM2Q0ZjhiN2Y2NGI4ZTFjNTJmYzIzM2UxZjRhN2I=	2010-12-14 17:59:46.884019	2010-12-14 17:59:46.884019
44	INVITE_STATUS	yes	2010-12-14 17:59:46.884019	2010-12-14 17:59:46.884019
44	ENABLED	Sim	2010-12-14 17:59:46.884019	2010-12-14 17:59:46.884019
45	PLAYERS	7	2010-12-14 18:11:45.931073	2010-12-14 18:11:45.931073
46	CONFIRM_CODE	ZGZmYmVkYTg5YWQzNTRiNjkxMWFlY2VmMjM0ODg4Yzc=	2010-12-14 18:11:45.943888	2010-12-14 18:11:45.943888
46	INVITE_STATUS	yes	2010-12-14 18:11:45.943888	2010-12-14 18:11:45.943888
46	ENABLED	Sim	2010-12-14 18:11:45.943888	2010-12-14 18:11:45.943888
47	PLAYERS	6	2010-12-14 18:13:28.74738	2010-12-14 18:13:28.74738
48	BUYIN	0	2010-12-14 18:13:28.778724	2010-12-14 18:13:28.778724
48	REBUY	0	2010-12-14 18:13:28.778724	2010-12-14 18:13:28.778724
48	ADDON	0	2010-12-14 18:13:28.778724	2010-12-14 18:13:28.778724
48	PRIZE	0	2010-12-14 18:13:28.778724	2010-12-14 18:13:28.778724
48	INVITE_STATUS	no	2010-12-14 18:13:28.778724	2010-12-14 18:13:28.778724
48	ENABLED	Não	2010-12-14 18:13:28.778724	2010-12-14 18:13:28.778724
49	PLAYERS	7	2010-12-14 18:13:45.211175	2010-12-14 18:13:45.211175
50	INVITE_STATUS	yes	2010-12-14 18:13:45.236123	2010-12-14 18:13:45.236123
50	ENABLED	Sim	2010-12-14 18:13:45.236123	2010-12-14 18:13:45.236123
51	CONFIRM_CODE	MGNhMTMwZTBkYWYwY2QxZWIzZGRkMWRlZmRhOTQ0NTU=	2010-12-14 18:13:58.466307	2010-12-14 18:13:58.466307
52	CONFIRM_CODE	YjM1MTljYjUyODlkMjkwZWQ0YTAwNTI3M2YxZDNkNWQ=	2010-12-14 18:13:58.587459	2010-12-14 18:13:58.587459
53	CONFIRM_CODE	OTAxYTY4NzYxNjgxNGVhODE4NWQ4MjI2YmFjOWNjMTM=	2010-12-14 18:13:58.594998	2010-12-14 18:13:58.594998
54	CONFIRM_CODE	ODA0ZDhiOThhMWJlMzM3MmNjNDg0N2RiZDk4Njg2ZDk=	2010-12-14 18:13:58.605645	2010-12-14 18:13:58.605645
55	CONFIRM_CODE	YTVlOGZhZjMxYjIzNmEzYTQ3Nzk2ZWVkZDVlNmU5ZTU=	2010-12-14 18:13:58.615321	2010-12-14 18:13:58.615321
56	CONFIRM_CODE	NWYzMjIzZWFkZjBjZTczODNjNWM0YzkxZWIwMjVlYWY=	2010-12-14 18:13:58.632287	2010-12-14 18:13:58.632287
57	CONFIRM_CODE	Yjk5ZWE0MTMyMDQxZjkzZDAyMDZkYWY5ZmEzZDcxZjA=	2010-12-14 18:13:58.678499	2010-12-14 18:13:58.678499
58	CONFIRM_CODE	NjBhNDM3N2NiOTlkYjE2NmFlZTJlODA2MWI1NWIzYTE=	2010-12-14 18:13:58.696551	2010-12-14 18:13:58.696551
59	CONFIRM_CODE	NjlkYTA0NjQ3MTMzMjdkY2M3YWNjZGJmOTcyYjUxNjc=	2010-12-14 18:13:58.72254	2010-12-14 18:13:58.72254
60	CONFIRM_CODE	NzAyZjcxMTA1OWVmOWVmOWI0YjJiYjZlMDYxOWJiMDY=	2010-12-14 18:13:58.745366	2010-12-14 18:13:58.745366
61	CONFIRM_CODE	YzM2MWQ0MmJhMTZjYzZiNjYwY2E0MGFlMTY3ZDYzYWI=	2010-12-14 18:13:58.790567	2010-12-14 18:13:58.790567
62	CONFIRM_CODE	M2ZhOTFjNTcwMzQzMjZmZjA4OWNlYjZmNDg5MzFmYzY=	2010-12-14 18:13:58.818545	2010-12-14 18:13:58.818545
63	CONFIRM_CODE	ZmMwNDBlMTUzNjRhYmUyZjY0NmJjOTdmNzU3NmI5YjA=	2010-12-14 18:13:58.854526	2010-12-14 18:13:58.854526
64	CONFIRM_CODE	NjU1MmUwYmYyMDE5YjliZmYzZWQ1OWQzNGY2NTc2NGE=	2010-12-14 18:13:58.898504	2010-12-14 18:13:58.898504
65	INVITES	18	2010-12-14 18:13:58.912028	2010-12-14 18:13:58.912028
66	PLAYERS	19	2010-12-15 02:13:06.757895	2010-12-15 02:13:06.757895
67	RANKING_ID	1	2010-12-15 02:13:06.776975	2010-12-15 02:13:06.776975
67	PEOPLE_ID	20	2010-12-15 02:13:06.776975	2010-12-15 02:13:06.776975
67	TOTAL_PAID	0	2010-12-15 02:13:06.776975	2010-12-15 02:13:06.776975
67	TOTAL_PRIZE	0	2010-12-15 02:13:06.776975	2010-12-15 02:13:06.776975
67	TOTAL_BALANCE	0	2010-12-15 02:13:06.776975	2010-12-15 02:13:06.776975
67	ENABLED	Sim	2010-12-15 02:13:06.776975	2010-12-15 02:13:06.776975
68	EVENT_ID	24	2010-12-15 02:13:06.851095	2010-12-15 02:13:06.851095
68	PEOPLE_ID	20	2010-12-15 02:13:06.851095	2010-12-15 02:13:06.851095
68	CONFIRM_CODE	MWRkZWY1MDYxMWQ0YzhlMzIyYjM5NGZjNGY5NTJlN2M=	2010-12-15 02:13:06.851095	2010-12-15 02:13:06.851095
68	INVITE_STATUS	none	2010-12-15 02:13:06.851095	2010-12-15 02:13:06.851095
68	DELETED	Não	2010-12-15 02:13:06.851095	2010-12-15 02:13:06.851095
69	EVENTS	18	2010-12-15 02:14:06.455619	2010-12-15 02:14:06.455619
70	DELETED	Sim	2010-12-15 02:14:06.474717	2010-12-15 02:14:06.474717
71	TOTAL_SCORE	329.46	2010-12-15 02:14:06.595422	2010-12-15 02:14:06.595422
72	EVENTS	19	2010-12-15 02:17:17.760681	2010-12-15 02:17:17.760681
73	EVENT_ID	33	2010-12-15 02:17:17.784728	2010-12-15 02:17:17.784728
73	PEOPLE_ID	8	2010-12-15 02:17:17.784728	2010-12-15 02:17:17.784728
73	CONFIRM_CODE	YmUxMGFmYWJkZDgwNGNmZGUxNDBiNGNjMWQ4MTNlN2E=	2010-12-15 02:17:17.784728	2010-12-15 02:17:17.784728
73	INVITE_STATUS	none	2010-12-15 02:17:17.784728	2010-12-15 02:17:17.784728
73	DELETED	Não	2010-12-15 02:17:17.784728	2010-12-15 02:17:17.784728
74	EVENT_ID	33	2010-12-15 02:17:17.79413	2010-12-15 02:17:17.79413
74	PEOPLE_ID	9	2010-12-15 02:17:17.79413	2010-12-15 02:17:17.79413
74	CONFIRM_CODE	ZDRlZDQzNDA1YzlmZjgyOThiYzAzZTRhOTBkZmYyNGI=	2010-12-15 02:17:17.79413	2010-12-15 02:17:17.79413
74	INVITE_STATUS	none	2010-12-15 02:17:17.79413	2010-12-15 02:17:17.79413
74	DELETED	Não	2010-12-15 02:17:17.79413	2010-12-15 02:17:17.79413
75	EVENT_ID	33	2010-12-15 02:17:17.805579	2010-12-15 02:17:17.805579
75	PEOPLE_ID	3	2010-12-15 02:17:17.805579	2010-12-15 02:17:17.805579
75	CONFIRM_CODE	OTdhNmE3ZDFlMmNjZDA3ZGRiMjYzZThlZTI1YmE1YTE=	2010-12-15 02:17:17.805579	2010-12-15 02:17:17.805579
75	INVITE_STATUS	none	2010-12-15 02:17:17.805579	2010-12-15 02:17:17.805579
75	DELETED	Não	2010-12-15 02:17:17.805579	2010-12-15 02:17:17.805579
76	EVENT_ID	33	2010-12-15 02:17:17.818932	2010-12-15 02:17:17.818932
76	PEOPLE_ID	10	2010-12-15 02:17:17.818932	2010-12-15 02:17:17.818932
76	CONFIRM_CODE	MGY1NzE3M2EyOGEwNzgxNDY5MTdhZWZlMDMzNTU2N2I=	2010-12-15 02:17:17.818932	2010-12-15 02:17:17.818932
76	INVITE_STATUS	none	2010-12-15 02:17:17.818932	2010-12-15 02:17:17.818932
76	DELETED	Não	2010-12-15 02:17:17.818932	2010-12-15 02:17:17.818932
77	EVENT_ID	33	2010-12-15 02:17:17.828659	2010-12-15 02:17:17.828659
77	PEOPLE_ID	7	2010-12-15 02:17:17.828659	2010-12-15 02:17:17.828659
77	CONFIRM_CODE	MGQ2M2YyNzYyOWJlMjM5NjVmY2YzNjYwNzFjY2ZjOWI=	2010-12-15 02:17:17.828659	2010-12-15 02:17:17.828659
77	INVITE_STATUS	none	2010-12-15 02:17:17.828659	2010-12-15 02:17:17.828659
77	DELETED	Não	2010-12-15 02:17:17.828659	2010-12-15 02:17:17.828659
78	EVENT_ID	33	2010-12-15 02:17:17.846053	2010-12-15 02:17:17.846053
78	PEOPLE_ID	19	2010-12-15 02:17:17.846053	2010-12-15 02:17:17.846053
78	CONFIRM_CODE	NjBkNjk4YTY3NTIzMTQ2YzM5MjNhYzIxMjBjMzE4ODQ=	2010-12-15 02:17:17.846053	2010-12-15 02:17:17.846053
78	INVITE_STATUS	none	2010-12-15 02:17:17.846053	2010-12-15 02:17:17.846053
78	DELETED	Não	2010-12-15 02:17:17.846053	2010-12-15 02:17:17.846053
79	EVENT_ID	33	2010-12-15 02:17:17.859407	2010-12-15 02:17:17.859407
79	PEOPLE_ID	20	2010-12-15 02:17:17.859407	2010-12-15 02:17:17.859407
79	CONFIRM_CODE	YzlhNzUzNmQxOGVlNDAwZmRlYmIyZDQxNGZiN2Q1NTA=	2010-12-15 02:17:17.859407	2010-12-15 02:17:17.859407
79	INVITE_STATUS	none	2010-12-15 02:17:17.859407	2010-12-15 02:17:17.859407
79	DELETED	Não	2010-12-15 02:17:17.859407	2010-12-15 02:17:17.859407
80	EVENT_ID	33	2010-12-15 02:17:17.883986	2010-12-15 02:17:17.883986
80	PEOPLE_ID	18	2010-12-15 02:17:17.883986	2010-12-15 02:17:17.883986
80	CONFIRM_CODE	NjA0MmE5MmIyNjE1Y2JiMTUyMjUzNDJiNTA3ZDQ1MjU=	2010-12-15 02:17:17.883986	2010-12-15 02:17:17.883986
80	INVITE_STATUS	none	2010-12-15 02:17:17.883986	2010-12-15 02:17:17.883986
80	DELETED	Não	2010-12-15 02:17:17.883986	2010-12-15 02:17:17.883986
81	EVENT_ID	33	2010-12-15 02:17:17.892541	2010-12-15 02:17:17.892541
81	PEOPLE_ID	5	2010-12-15 02:17:17.892541	2010-12-15 02:17:17.892541
81	CONFIRM_CODE	ODJlYjg2OTUxZjc2ZTI1NGIyZjBmOWM4MzE0MTI1NjY=	2010-12-15 02:17:17.892541	2010-12-15 02:17:17.892541
81	INVITE_STATUS	none	2010-12-15 02:17:17.892541	2010-12-15 02:17:17.892541
81	DELETED	Não	2010-12-15 02:17:17.892541	2010-12-15 02:17:17.892541
82	EVENT_ID	33	2010-12-15 02:17:17.901711	2010-12-15 02:17:17.901711
82	PEOPLE_ID	6	2010-12-15 02:17:17.901711	2010-12-15 02:17:17.901711
82	CONFIRM_CODE	NDQ4ZWZmZDEzOThiNjAxOWZlN2NlYTVmOTVkNDY3MTI=	2010-12-15 02:17:17.901711	2010-12-15 02:17:17.901711
82	INVITE_STATUS	none	2010-12-15 02:17:17.901711	2010-12-15 02:17:17.901711
82	DELETED	Não	2010-12-15 02:17:17.901711	2010-12-15 02:17:17.901711
83	EVENT_ID	33	2010-12-15 02:17:17.913686	2010-12-15 02:17:17.913686
83	PEOPLE_ID	1	2010-12-15 02:17:17.913686	2010-12-15 02:17:17.913686
83	CONFIRM_CODE	MThkODE5MGNkOTBlNDE1OGI5MjZjMDdiYzYxODNkY2M=	2010-12-15 02:17:17.913686	2010-12-15 02:17:17.913686
83	INVITE_STATUS	none	2010-12-15 02:17:17.913686	2010-12-15 02:17:17.913686
83	DELETED	Não	2010-12-15 02:17:17.913686	2010-12-15 02:17:17.913686
84	EVENT_ID	33	2010-12-15 02:17:17.922824	2010-12-15 02:17:17.922824
84	PEOPLE_ID	17	2010-12-15 02:17:17.922824	2010-12-15 02:17:17.922824
84	CONFIRM_CODE	NGE1MDNhOWMwYzBjMWQzYzY1OTU0MjUxZjcwOWFiZTc=	2010-12-15 02:17:17.922824	2010-12-15 02:17:17.922824
84	INVITE_STATUS	none	2010-12-15 02:17:17.922824	2010-12-15 02:17:17.922824
84	DELETED	Não	2010-12-15 02:17:17.922824	2010-12-15 02:17:17.922824
85	EVENT_ID	33	2010-12-15 02:17:17.935172	2010-12-15 02:17:17.935172
85	PEOPLE_ID	11	2010-12-15 02:17:17.935172	2010-12-15 02:17:17.935172
85	CONFIRM_CODE	MWU3Yzc3ODM1NmY1ZTlhYmI2MDhjZWZhZGZkMDhlNjI=	2010-12-15 02:17:17.935172	2010-12-15 02:17:17.935172
85	INVITE_STATUS	none	2010-12-15 02:17:17.935172	2010-12-15 02:17:17.935172
85	DELETED	Não	2010-12-15 02:17:17.935172	2010-12-15 02:17:17.935172
86	EVENT_ID	33	2010-12-15 02:17:17.948711	2010-12-15 02:17:17.948711
86	PEOPLE_ID	12	2010-12-15 02:17:17.948711	2010-12-15 02:17:17.948711
86	CONFIRM_CODE	OTk4NmFkN2E5NTZlOWZiZTI0NTNkOWU0OTM1NWZkY2U=	2010-12-15 02:17:17.948711	2010-12-15 02:17:17.948711
86	INVITE_STATUS	none	2010-12-15 02:17:17.948711	2010-12-15 02:17:17.948711
86	DELETED	Não	2010-12-15 02:17:17.948711	2010-12-15 02:17:17.948711
87	EVENT_ID	33	2010-12-15 02:17:17.966766	2010-12-15 02:17:17.966766
87	PEOPLE_ID	4	2010-12-15 02:17:17.966766	2010-12-15 02:17:17.966766
87	CONFIRM_CODE	M2QwYWYxZDZjYTg2ZWRiYWM3YTA4MDMyZjcxMDNjNTM=	2010-12-15 02:17:17.966766	2010-12-15 02:17:17.966766
87	INVITE_STATUS	none	2010-12-15 02:17:17.966766	2010-12-15 02:17:17.966766
87	DELETED	Não	2010-12-15 02:17:17.966766	2010-12-15 02:17:17.966766
88	EVENT_ID	33	2010-12-15 02:17:17.99478	2010-12-15 02:17:17.99478
88	PEOPLE_ID	15	2010-12-15 02:17:17.99478	2010-12-15 02:17:17.99478
88	CONFIRM_CODE	YjYzNGY5ZDM1MDZmNWY0YWVjNmRjODU4MjZiMDNmYjc=	2010-12-15 02:17:17.99478	2010-12-15 02:17:17.99478
88	INVITE_STATUS	none	2010-12-15 02:17:17.99478	2010-12-15 02:17:17.99478
88	DELETED	Não	2010-12-15 02:17:17.99478	2010-12-15 02:17:17.99478
89	EVENT_ID	33	2010-12-15 02:17:18.003222	2010-12-15 02:17:18.003222
89	PEOPLE_ID	14	2010-12-15 02:17:18.003222	2010-12-15 02:17:18.003222
89	CONFIRM_CODE	MTFkNDA1Mjc2MDEzZjFkZTI1YjVkOTM5ZDE5ZTgwYTk=	2010-12-15 02:17:18.003222	2010-12-15 02:17:18.003222
89	INVITE_STATUS	none	2010-12-15 02:17:18.003222	2010-12-15 02:17:18.003222
89	DELETED	Não	2010-12-15 02:17:18.003222	2010-12-15 02:17:18.003222
90	EVENT_ID	33	2010-12-15 02:17:18.01576	2010-12-15 02:17:18.01576
90	PEOPLE_ID	13	2010-12-15 02:17:18.01576	2010-12-15 02:17:18.01576
90	CONFIRM_CODE	NDZmZjViOTliNTMyOGRmYTY5Mzg5MWI2YzA3NTExMTg=	2010-12-15 02:17:18.01576	2010-12-15 02:17:18.01576
90	INVITE_STATUS	none	2010-12-15 02:17:18.01576	2010-12-15 02:17:18.01576
90	DELETED	Não	2010-12-15 02:17:18.01576	2010-12-15 02:17:18.01576
91	EVENT_ID	33	2010-12-15 02:17:18.027971	2010-12-15 02:17:18.027971
91	PEOPLE_ID	2	2010-12-15 02:17:18.027971	2010-12-15 02:17:18.027971
91	CONFIRM_CODE	NzViMDFhOGVkMWFlMWFjYWI3OTVhOTVhYjJjMTUxZDk=	2010-12-15 02:17:18.027971	2010-12-15 02:17:18.027971
91	INVITE_STATUS	none	2010-12-15 02:17:18.027971	2010-12-15 02:17:18.027971
91	DELETED	Não	2010-12-15 02:17:18.027971	2010-12-15 02:17:18.027971
92	RANKING_ID	1	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	EVENT_NAME	Sit & Go - NLHE #1	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	EVENT_PLACE	AP 31 Cassinos Bar	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	BUYIN	10	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	PAID_PLACES	2	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	EVENT_DATE	2010-12-14	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	START_TIME	20:00:00	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	INVITES	19	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	ENABLED	Sim	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
92	VISIBLE	Sim	2010-12-15 02:17:18.033814	2010-12-15 02:17:18.033814
93	EVENT_ID	34	2010-12-15 02:17:51.828849	2010-12-15 02:17:51.828849
93	PEOPLE_ID	8	2010-12-15 02:17:51.828849	2010-12-15 02:17:51.828849
93	INVITE_STATUS	none	2010-12-15 02:17:51.828849	2010-12-15 02:17:51.828849
93	ENABLED	Não	2010-12-15 02:17:51.828849	2010-12-15 02:17:51.828849
94	EVENT_ID	34	2010-12-15 02:17:51.837481	2010-12-15 02:17:51.837481
94	PEOPLE_ID	9	2010-12-15 02:17:51.837481	2010-12-15 02:17:51.837481
94	INVITE_STATUS	none	2010-12-15 02:17:51.837481	2010-12-15 02:17:51.837481
94	ENABLED	Não	2010-12-15 02:17:51.837481	2010-12-15 02:17:51.837481
95	EVENT_ID	34	2010-12-15 02:17:51.849696	2010-12-15 02:17:51.849696
95	PEOPLE_ID	3	2010-12-15 02:17:51.849696	2010-12-15 02:17:51.849696
95	INVITE_STATUS	none	2010-12-15 02:17:51.849696	2010-12-15 02:17:51.849696
95	ENABLED	Não	2010-12-15 02:17:51.849696	2010-12-15 02:17:51.849696
96	EVENT_ID	34	2010-12-15 02:17:51.861028	2010-12-15 02:17:51.861028
96	PEOPLE_ID	10	2010-12-15 02:17:51.861028	2010-12-15 02:17:51.861028
96	INVITE_STATUS	none	2010-12-15 02:17:51.861028	2010-12-15 02:17:51.861028
96	ENABLED	Não	2010-12-15 02:17:51.861028	2010-12-15 02:17:51.861028
97	EVENT_ID	34	2010-12-15 02:17:51.871518	2010-12-15 02:17:51.871518
97	PEOPLE_ID	7	2010-12-15 02:17:51.871518	2010-12-15 02:17:51.871518
97	INVITE_STATUS	none	2010-12-15 02:17:51.871518	2010-12-15 02:17:51.871518
97	ENABLED	Não	2010-12-15 02:17:51.871518	2010-12-15 02:17:51.871518
98	EVENT_ID	34	2010-12-15 02:17:51.884797	2010-12-15 02:17:51.884797
98	PEOPLE_ID	19	2010-12-15 02:17:51.884797	2010-12-15 02:17:51.884797
98	INVITE_STATUS	none	2010-12-15 02:17:51.884797	2010-12-15 02:17:51.884797
98	ENABLED	Não	2010-12-15 02:17:51.884797	2010-12-15 02:17:51.884797
99	EVENT_ID	34	2010-12-15 02:17:51.898168	2010-12-15 02:17:51.898168
99	PEOPLE_ID	20	2010-12-15 02:17:51.898168	2010-12-15 02:17:51.898168
99	INVITE_STATUS	none	2010-12-15 02:17:51.898168	2010-12-15 02:17:51.898168
99	ENABLED	Não	2010-12-15 02:17:51.898168	2010-12-15 02:17:51.898168
100	EVENT_ID	34	2010-12-15 02:17:51.907835	2010-12-15 02:17:51.907835
100	PEOPLE_ID	18	2010-12-15 02:17:51.907835	2010-12-15 02:17:51.907835
100	INVITE_STATUS	none	2010-12-15 02:17:51.907835	2010-12-15 02:17:51.907835
100	ENABLED	Não	2010-12-15 02:17:51.907835	2010-12-15 02:17:51.907835
101	EVENT_ID	34	2010-12-15 02:17:51.917133	2010-12-15 02:17:51.917133
101	PEOPLE_ID	5	2010-12-15 02:17:51.917133	2010-12-15 02:17:51.917133
101	INVITE_STATUS	none	2010-12-15 02:17:51.917133	2010-12-15 02:17:51.917133
101	ENABLED	Não	2010-12-15 02:17:51.917133	2010-12-15 02:17:51.917133
102	EVENT_ID	34	2010-12-15 02:17:51.933009	2010-12-15 02:17:51.933009
102	PEOPLE_ID	6	2010-12-15 02:17:51.933009	2010-12-15 02:17:51.933009
102	INVITE_STATUS	none	2010-12-15 02:17:51.933009	2010-12-15 02:17:51.933009
102	ENABLED	Não	2010-12-15 02:17:51.933009	2010-12-15 02:17:51.933009
103	EVENT_ID	34	2010-12-15 02:17:51.940443	2010-12-15 02:17:51.940443
103	PEOPLE_ID	1	2010-12-15 02:17:51.940443	2010-12-15 02:17:51.940443
103	INVITE_STATUS	none	2010-12-15 02:17:51.940443	2010-12-15 02:17:51.940443
103	ENABLED	Não	2010-12-15 02:17:51.940443	2010-12-15 02:17:51.940443
104	EVENT_ID	34	2010-12-15 02:17:51.948196	2010-12-15 02:17:51.948196
104	PEOPLE_ID	17	2010-12-15 02:17:51.948196	2010-12-15 02:17:51.948196
104	INVITE_STATUS	none	2010-12-15 02:17:51.948196	2010-12-15 02:17:51.948196
104	ENABLED	Não	2010-12-15 02:17:51.948196	2010-12-15 02:17:51.948196
105	EVENT_ID	34	2010-12-15 02:17:51.955886	2010-12-15 02:17:51.955886
105	PEOPLE_ID	11	2010-12-15 02:17:51.955886	2010-12-15 02:17:51.955886
105	INVITE_STATUS	none	2010-12-15 02:17:51.955886	2010-12-15 02:17:51.955886
105	ENABLED	Não	2010-12-15 02:17:51.955886	2010-12-15 02:17:51.955886
106	EVENT_ID	34	2010-12-15 02:17:51.963436	2010-12-15 02:17:51.963436
106	PEOPLE_ID	12	2010-12-15 02:17:51.963436	2010-12-15 02:17:51.963436
106	INVITE_STATUS	none	2010-12-15 02:17:51.963436	2010-12-15 02:17:51.963436
106	ENABLED	Não	2010-12-15 02:17:51.963436	2010-12-15 02:17:51.963436
107	EVENT_ID	34	2010-12-15 02:17:51.973383	2010-12-15 02:17:51.973383
107	PEOPLE_ID	4	2010-12-15 02:17:51.973383	2010-12-15 02:17:51.973383
107	INVITE_STATUS	none	2010-12-15 02:17:51.973383	2010-12-15 02:17:51.973383
107	ENABLED	Não	2010-12-15 02:17:51.973383	2010-12-15 02:17:51.973383
108	EVENT_ID	34	2010-12-15 02:17:51.982458	2010-12-15 02:17:51.982458
108	PEOPLE_ID	15	2010-12-15 02:17:51.982458	2010-12-15 02:17:51.982458
108	INVITE_STATUS	none	2010-12-15 02:17:51.982458	2010-12-15 02:17:51.982458
108	ENABLED	Não	2010-12-15 02:17:51.982458	2010-12-15 02:17:51.982458
109	EVENT_ID	34	2010-12-15 02:17:51.990596	2010-12-15 02:17:51.990596
109	PEOPLE_ID	14	2010-12-15 02:17:51.990596	2010-12-15 02:17:51.990596
109	INVITE_STATUS	none	2010-12-15 02:17:51.990596	2010-12-15 02:17:51.990596
109	ENABLED	Não	2010-12-15 02:17:51.990596	2010-12-15 02:17:51.990596
110	EVENT_ID	34	2010-12-15 02:17:51.998377	2010-12-15 02:17:51.998377
110	PEOPLE_ID	13	2010-12-15 02:17:51.998377	2010-12-15 02:17:51.998377
110	INVITE_STATUS	none	2010-12-15 02:17:51.998377	2010-12-15 02:17:51.998377
110	ENABLED	Não	2010-12-15 02:17:51.998377	2010-12-15 02:17:51.998377
111	EVENT_ID	34	2010-12-15 02:17:52.008881	2010-12-15 02:17:52.008881
111	PEOPLE_ID	2	2010-12-15 02:17:52.008881	2010-12-15 02:17:52.008881
111	INVITE_STATUS	none	2010-12-15 02:17:52.008881	2010-12-15 02:17:52.008881
111	ENABLED	Não	2010-12-15 02:17:52.008881	2010-12-15 02:17:52.008881
112	EVENTS	20	2010-12-15 02:18:09.46733	2010-12-15 02:18:09.46733
113	CONFIRM_CODE	YzVlNzNmZDBmNjJmNjM3YzBmN2JlMWUwOGNjYTEwYWU=	2010-12-15 02:18:09.481508	2010-12-15 02:18:09.481508
114	CONFIRM_CODE	MTAxZGNkN2YxYjljZjQxNTRhZjlmNTk0NTJiZGE4NzM=	2010-12-15 02:18:09.489047	2010-12-15 02:18:09.489047
115	CONFIRM_CODE	ZTE5YWExYmIxNzYzOWY3YTY1MGE4YTgxNDBlNjJlOTE=	2010-12-15 02:18:09.497128	2010-12-15 02:18:09.497128
116	CONFIRM_CODE	NTQ2Njc4N2RkYmRhMGQ4ZTBjN2M5YTMxZDc4ZDI5YzY=	2010-12-15 02:18:09.506564	2010-12-15 02:18:09.506564
117	CONFIRM_CODE	MzVmZDFkOTNlMzhmNGEwYzBlZTgxZDI2NzVmMTUzYjQ=	2010-12-15 02:18:09.51415	2010-12-15 02:18:09.51415
118	CONFIRM_CODE	ODI2ZjQ4ZmY4MjllMDU0Y2ZhYjA4ZWNhNGE1OWU3YjE=	2010-12-15 02:18:09.523284	2010-12-15 02:18:09.523284
119	CONFIRM_CODE	Yzc2NGJjOGFkYjU5ZDcxZDU0NDkyMTdlMTY5MGYxMmM=	2010-12-15 02:18:09.546936	2010-12-15 02:18:09.546936
120	CONFIRM_CODE	ODcxNDE2ODFhYjc2NWRlYjFkZjQ1YzdiNGE0YWU1NDg=	2010-12-15 02:18:09.555031	2010-12-15 02:18:09.555031
121	CONFIRM_CODE	YjFhOWVmNzZkNTk4N2QyYmNlMjQ0Y2Q1ZWVmNGRlNmY=	2010-12-15 02:18:09.596634	2010-12-15 02:18:09.596634
122	CONFIRM_CODE	ZDhmODFkMzllNzk5NTgwMDVjNjg1MWEyMWU1Y2VlYTU=	2010-12-15 02:18:09.604034	2010-12-15 02:18:09.604034
123	CONFIRM_CODE	Y2ZiNDVhNGZjYTkxN2E2MWMwMjk5OGExOWEwNDlhMGY=	2010-12-15 02:18:09.632012	2010-12-15 02:18:09.632012
124	CONFIRM_CODE	ZWNhZjVkZTJkMzI3ZDcxZTVlZTYwOWM0ODFlOTBjYTY=	2010-12-15 02:18:09.643236	2010-12-15 02:18:09.643236
125	CONFIRM_CODE	ZTUwZjIyMWM0MDg2ZTFjNzc4NzNiM2E3YTY2YTBmYTI=	2010-12-15 02:18:09.65048	2010-12-15 02:18:09.65048
126	CONFIRM_CODE	NGQ1MGZkNTkxNjk1MmUxNzY0ZmVkOTAwNDZjYWIwOWE=	2010-12-15 02:18:09.659655	2010-12-15 02:18:09.659655
127	CONFIRM_CODE	YTZmNWU3YTgwZGY1NjVhZTE3YzNmMmI3ZmEwMmRiNGQ=	2010-12-15 02:18:09.670538	2010-12-15 02:18:09.670538
128	CONFIRM_CODE	ODIwYzJlOTYyNjA5YmQxZjc4YjYzZjIxYjRkMDA1Y2Y=	2010-12-15 02:18:09.678244	2010-12-15 02:18:09.678244
129	CONFIRM_CODE	NTA1ZTdkZWQwYzU5YzEzNzJiZmNhZmEyY2JmYTVmNWI=	2010-12-15 02:18:09.688945	2010-12-15 02:18:09.688945
130	CONFIRM_CODE	NWU2OGU1MjI5MWRiMjA3MDU1NjA0Y2I1YmI0NDYzYzY=	2010-12-15 02:18:09.699846	2010-12-15 02:18:09.699846
131	CONFIRM_CODE	MjUxNWRjZjVlOWJlMTQ0MzFhMDMzOTBhMDRiMWIwYzc=	2010-12-15 02:18:09.706586	2010-12-15 02:18:09.706586
132	EVENT_NAME	Sit & Go - NLHE #2	2010-12-15 02:18:09.711421	2010-12-15 02:18:09.711421
132	ENABLED	Sim	2010-12-15 02:18:09.711421	2010-12-15 02:18:09.711421
132	VISIBLE	Sim	2010-12-15 02:18:09.711421	2010-12-15 02:18:09.711421
133	PLAYERS	1	2010-12-15 02:20:23.016541	2010-12-15 02:20:23.016541
134	INVITE_STATUS	yes	2010-12-15 02:20:23.02178	2010-12-15 02:20:23.02178
134	ENABLED	Sim	2010-12-15 02:20:23.02178	2010-12-15 02:20:23.02178
135	BUYIN	10	2010-12-15 02:20:23.028469	2010-12-15 02:20:23.028469
135	EVENT_POSITION	4	2010-12-15 02:20:23.028469	2010-12-15 02:20:23.028469
136	PLAYERS	2	2010-12-15 02:20:23.065601	2010-12-15 02:20:23.065601
137	INVITE_STATUS	yes	2010-12-15 02:20:23.084132	2010-12-15 02:20:23.084132
137	ENABLED	Sim	2010-12-15 02:20:23.084132	2010-12-15 02:20:23.084132
138	BUYIN	10	2010-12-15 02:20:23.094854	2010-12-15 02:20:23.094854
138	EVENT_POSITION	2	2010-12-15 02:20:23.094854	2010-12-15 02:20:23.094854
138	PRIZE	20	2010-12-15 02:20:23.094854	2010-12-15 02:20:23.094854
139	PLAYERS	3	2010-12-15 02:20:23.113079	2010-12-15 02:20:23.113079
140	INVITE_STATUS	yes	2010-12-15 02:20:23.133609	2010-12-15 02:20:23.133609
140	ENABLED	Sim	2010-12-15 02:20:23.133609	2010-12-15 02:20:23.133609
141	BUYIN	10	2010-12-15 02:20:23.149953	2010-12-15 02:20:23.149953
141	EVENT_POSITION	6	2010-12-15 02:20:23.149953	2010-12-15 02:20:23.149953
142	PLAYERS	4	2010-12-15 02:20:23.23448	2010-12-15 02:20:23.23448
143	INVITE_STATUS	yes	2010-12-15 02:20:23.300059	2010-12-15 02:20:23.300059
143	ENABLED	Sim	2010-12-15 02:20:23.300059	2010-12-15 02:20:23.300059
144	BUYIN	10	2010-12-15 02:20:23.310106	2010-12-15 02:20:23.310106
144	EVENT_POSITION	1	2010-12-15 02:20:23.310106	2010-12-15 02:20:23.310106
144	PRIZE	40	2010-12-15 02:20:23.310106	2010-12-15 02:20:23.310106
145	PLAYERS	5	2010-12-15 02:20:23.323471	2010-12-15 02:20:23.323471
146	INVITE_STATUS	yes	2010-12-15 02:20:23.329864	2010-12-15 02:20:23.329864
146	ENABLED	Sim	2010-12-15 02:20:23.329864	2010-12-15 02:20:23.329864
147	BUYIN	10	2010-12-15 02:20:23.337091	2010-12-15 02:20:23.337091
147	EVENT_POSITION	3	2010-12-15 02:20:23.337091	2010-12-15 02:20:23.337091
148	PLAYERS	6	2010-12-15 02:20:23.355114	2010-12-15 02:20:23.355114
149	INVITE_STATUS	yes	2010-12-15 02:20:23.360006	2010-12-15 02:20:23.360006
149	ENABLED	Sim	2010-12-15 02:20:23.360006	2010-12-15 02:20:23.360006
150	BUYIN	10	2010-12-15 02:20:23.366942	2010-12-15 02:20:23.366942
150	EVENT_POSITION	5	2010-12-15 02:20:23.366942	2010-12-15 02:20:23.366942
151	SAVED_RESULT	Sim	2010-12-15 02:20:23.37767	2010-12-15 02:20:23.37767
152	TOTAL_EVENTS	10	2010-12-15 02:20:23.572424	2010-12-15 02:20:23.572424
152	TOTAL_SCORE	161.8	2010-12-15 02:20:23.572424	2010-12-15 02:20:23.572424
152	TOTAL_PAID	110	2010-12-15 02:20:23.572424	2010-12-15 02:20:23.572424
152	TOTAL_BALANCE	-42	2010-12-15 02:20:23.572424	2010-12-15 02:20:23.572424
152	TOTAL_AVERAGE	0.618	2010-12-15 02:20:23.572424	2010-12-15 02:20:23.572424
153	TOTAL_EVENTS	1	2010-12-15 02:20:23.636379	2010-12-15 02:20:23.636379
153	TOTAL_SCORE	30	2010-12-15 02:20:23.636379	2010-12-15 02:20:23.636379
153	TOTAL_PAID	10	2010-12-15 02:20:23.636379	2010-12-15 02:20:23.636379
153	TOTAL_PRIZE	20	2010-12-15 02:20:23.636379	2010-12-15 02:20:23.636379
153	TOTAL_BALANCE	10	2010-12-15 02:20:23.636379	2010-12-15 02:20:23.636379
153	TOTAL_AVERAGE	2	2010-12-15 02:20:23.636379	2010-12-15 02:20:23.636379
154	TOTAL_EVENTS	19	2010-12-15 02:20:23.697788	2010-12-15 02:20:23.697788
154	TOTAL_SCORE	352.83	2010-12-15 02:20:23.697788	2010-12-15 02:20:23.697788
154	TOTAL_PAID	210	2010-12-15 02:20:23.697788	2010-12-15 02:20:23.697788
154	TOTAL_BALANCE	-30	2010-12-15 02:20:23.697788	2010-12-15 02:20:23.697788
154	TOTAL_AVERAGE	0.857	2010-12-15 02:20:23.697788	2010-12-15 02:20:23.697788
155	TOTAL_EVENTS	1	2010-12-15 02:20:23.706438	2010-12-15 02:20:23.706438
155	TOTAL_SCORE	50	2010-12-15 02:20:23.706438	2010-12-15 02:20:23.706438
155	TOTAL_PAID	10	2010-12-15 02:20:23.706438	2010-12-15 02:20:23.706438
155	TOTAL_PRIZE	40	2010-12-15 02:20:23.706438	2010-12-15 02:20:23.706438
155	TOTAL_BALANCE	30	2010-12-15 02:20:23.706438	2010-12-15 02:20:23.706438
155	TOTAL_AVERAGE	4	2010-12-15 02:20:23.706438	2010-12-15 02:20:23.706438
156	TOTAL_EVENTS	18	2010-12-15 02:20:23.720817	2010-12-15 02:20:23.720817
156	TOTAL_SCORE	341.1	2010-12-15 02:20:23.720817	2010-12-15 02:20:23.720817
156	TOTAL_PAID	220	2010-12-15 02:20:23.720817	2010-12-15 02:20:23.720817
156	TOTAL_BALANCE	-23	2010-12-15 02:20:23.720817	2010-12-15 02:20:23.720817
156	TOTAL_AVERAGE	0.895	2010-12-15 02:20:23.720817	2010-12-15 02:20:23.720817
157	TOTAL_EVENTS	19	2010-12-15 02:20:23.738038	2010-12-15 02:20:23.738038
157	TOTAL_SCORE	463.79	2010-12-15 02:20:23.738038	2010-12-15 02:20:23.738038
157	TOTAL_PAID	220	2010-12-15 02:20:23.738038	2010-12-15 02:20:23.738038
157	TOTAL_BALANCE	97	2010-12-15 02:20:23.738038	2010-12-15 02:20:23.738038
157	TOTAL_AVERAGE	1.441	2010-12-15 02:20:23.738038	2010-12-15 02:20:23.738038
158	RANKING_ID	1	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	PEOPLE_ID	8	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	EVENTS	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	SCORE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	AVERAGE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	PAID_VALUE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	PRIZE_VALUE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	BALANCE_VALUE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	TOTAL_EVENTS	1	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	TOTAL_SCORE	10	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	TOTAL_PAID	10	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	TOTAL_PRIZE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	TOTAL_BALANCE	-10	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	TOTAL_AVERAGE	0	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
158	ENABLED	Sim	2010-12-15 02:20:23.884652	2010-12-15 02:20:23.884652
159	RANKING_ID	1	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	PEOPLE_ID	9	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	EVENTS	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	SCORE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	AVERAGE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	PAID_VALUE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	PRIZE_VALUE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	BALANCE_VALUE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	TOTAL_EVENTS	4	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	TOTAL_SCORE	40	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	TOTAL_PAID	50	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	TOTAL_PRIZE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	TOTAL_BALANCE	-50	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	TOTAL_AVERAGE	0	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
159	ENABLED	Sim	2010-12-15 02:20:23.896241	2010-12-15 02:20:23.896241
160	RANKING_ID	1	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	PEOPLE_ID	3	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	EVENTS	0	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	SCORE	0	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	AVERAGE	0	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	PAID_VALUE	0	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	PRIZE_VALUE	0	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	BALANCE_VALUE	0	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	TOTAL_EVENTS	18	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	TOTAL_SCORE	396	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	TOTAL_PAID	190	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	TOTAL_PRIZE	228	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	TOTAL_BALANCE	38	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	TOTAL_AVERAGE	1.2	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
160	ENABLED	Sim	2010-12-15 02:20:23.907275	2010-12-15 02:20:23.907275
161	RANKING_ID	1	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	PEOPLE_ID	10	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	EVENTS	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	SCORE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	AVERAGE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	PAID_VALUE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	PRIZE_VALUE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	BALANCE_VALUE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	TOTAL_EVENTS	1	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	TOTAL_SCORE	10	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	TOTAL_PAID	10	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	TOTAL_PRIZE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	TOTAL_BALANCE	-10	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	TOTAL_AVERAGE	0	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
161	ENABLED	Sim	2010-12-15 02:20:23.918961	2010-12-15 02:20:23.918961
162	RANKING_ID	1	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	PEOPLE_ID	7	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	EVENTS	1	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	SCORE	10	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	AVERAGE	0	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	PAID_VALUE	10	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	PRIZE_VALUE	0	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	BALANCE_VALUE	-10	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	TOTAL_EVENTS	10	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	TOTAL_SCORE	161.8	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	TOTAL_PAID	110	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	TOTAL_PRIZE	68	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	TOTAL_BALANCE	-42	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	TOTAL_AVERAGE	0.618	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
162	ENABLED	Sim	2010-12-15 02:20:23.92899	2010-12-15 02:20:23.92899
163	RANKING_ID	1	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	PEOPLE_ID	19	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	EVENTS	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	SCORE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	AVERAGE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	PAID_VALUE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	PRIZE_VALUE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	BALANCE_VALUE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	TOTAL_EVENTS	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	TOTAL_SCORE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	TOTAL_PAID	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	TOTAL_PRIZE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	TOTAL_BALANCE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	TOTAL_AVERAGE	0	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
163	ENABLED	Sim	2010-12-15 02:20:23.94083	2010-12-15 02:20:23.94083
164	RANKING_ID	1	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	PEOPLE_ID	20	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	EVENTS	1	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	SCORE	30	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	AVERAGE	2	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	PAID_VALUE	10	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	PRIZE_VALUE	20	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	BALANCE_VALUE	10	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	TOTAL_EVENTS	1	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	TOTAL_SCORE	30	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	TOTAL_PAID	10	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	TOTAL_PRIZE	20	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	TOTAL_BALANCE	10	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	TOTAL_AVERAGE	2	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
164	ENABLED	Sim	2010-12-15 02:20:23.952321	2010-12-15 02:20:23.952321
165	RANKING_ID	1	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	PEOPLE_ID	18	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	EVENTS	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	SCORE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	AVERAGE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	PAID_VALUE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	PRIZE_VALUE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	BALANCE_VALUE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	TOTAL_EVENTS	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	TOTAL_SCORE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	TOTAL_PAID	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	TOTAL_PRIZE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	TOTAL_BALANCE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	TOTAL_AVERAGE	0	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
165	ENABLED	Sim	2010-12-15 02:20:23.964205	2010-12-15 02:20:23.964205
166	RANKING_ID	1	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	PEOPLE_ID	5	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	RANKING_DATE	2010-12-14	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	EVENTS	0	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	SCORE	0	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	AVERAGE	0	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	PAID_VALUE	0	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	PRIZE_VALUE	0	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	BALANCE_VALUE	0	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	TOTAL_EVENTS	12	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	TOTAL_SCORE	176.04	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	TOTAL_PAID	150	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	TOTAL_PRIZE	70	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	TOTAL_BALANCE	-80	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	TOTAL_AVERAGE	0.467	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
166	ENABLED	Sim	2010-12-15 02:20:23.986397	2010-12-15 02:20:23.986397
167	RANKING_ID	1	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	PEOPLE_ID	6	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	EVENTS	0	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	SCORE	0	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	AVERAGE	0	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	PAID_VALUE	0	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	PRIZE_VALUE	0	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	BALANCE_VALUE	0	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	TOTAL_EVENTS	16	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	TOTAL_SCORE	362.08	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	TOTAL_PAID	190	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	TOTAL_PRIZE	240	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	TOTAL_BALANCE	50	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	TOTAL_AVERAGE	1.263	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
167	ENABLED	Sim	2010-12-15 02:20:24.021913	2010-12-15 02:20:24.021913
168	RANKING_ID	1	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	PEOPLE_ID	1	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	EVENTS	1	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	SCORE	10	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	AVERAGE	0	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	PAID_VALUE	10	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	PRIZE_VALUE	0	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	BALANCE_VALUE	-10	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	TOTAL_EVENTS	19	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	TOTAL_SCORE	352.83	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	TOTAL_PAID	210	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	TOTAL_PRIZE	180	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	TOTAL_BALANCE	-30	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	TOTAL_AVERAGE	0.857	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
168	ENABLED	Sim	2010-12-15 02:20:24.051253	2010-12-15 02:20:24.051253
169	RANKING_ID	1	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	PEOPLE_ID	17	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	EVENTS	1	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	SCORE	50	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	AVERAGE	4	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	PAID_VALUE	10	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	PRIZE_VALUE	40	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	BALANCE_VALUE	30	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	TOTAL_EVENTS	1	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	TOTAL_SCORE	50	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	TOTAL_PAID	10	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	TOTAL_PRIZE	40	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	TOTAL_BALANCE	30	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	TOTAL_AVERAGE	4	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
169	ENABLED	Sim	2010-12-15 02:20:24.089784	2010-12-15 02:20:24.089784
170	RANKING_ID	1	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	PEOPLE_ID	11	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	EVENTS	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	SCORE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	AVERAGE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	PAID_VALUE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	PRIZE_VALUE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	BALANCE_VALUE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	TOTAL_EVENTS	2	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	TOTAL_SCORE	20	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	TOTAL_PAID	20	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	TOTAL_PRIZE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	TOTAL_BALANCE	-20	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	TOTAL_AVERAGE	0	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
170	ENABLED	Sim	2010-12-15 02:20:24.105866	2010-12-15 02:20:24.105866
171	RANKING_ID	1	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	PEOPLE_ID	12	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	EVENTS	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	SCORE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	AVERAGE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	PAID_VALUE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	PRIZE_VALUE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	BALANCE_VALUE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	TOTAL_EVENTS	2	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	TOTAL_SCORE	20	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	TOTAL_PAID	20	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	TOTAL_PRIZE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	TOTAL_BALANCE	-20	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	TOTAL_AVERAGE	0	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
171	ENABLED	Sim	2010-12-15 02:20:24.123486	2010-12-15 02:20:24.123486
172	RANKING_ID	1	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	PEOPLE_ID	4	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	EVENTS	1	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	SCORE	10	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	AVERAGE	0	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	PAID_VALUE	10	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	PRIZE_VALUE	0	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	BALANCE_VALUE	-10	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	TOTAL_EVENTS	18	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	TOTAL_SCORE	341.1	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	TOTAL_PAID	220	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	TOTAL_PRIZE	197	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	TOTAL_BALANCE	-23	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	TOTAL_AVERAGE	0.895	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
172	ENABLED	Sim	2010-12-15 02:20:24.140603	2010-12-15 02:20:24.140603
173	RANKING_ID	1	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	PEOPLE_ID	15	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	EVENTS	0	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	SCORE	0	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	AVERAGE	0	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	PAID_VALUE	0	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	PRIZE_VALUE	0	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	BALANCE_VALUE	0	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	TOTAL_EVENTS	4	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	TOTAL_SCORE	120	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	TOTAL_PAID	40	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	TOTAL_PRIZE	80	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	TOTAL_BALANCE	40	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	TOTAL_AVERAGE	2	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
173	ENABLED	Sim	2010-12-15 02:20:24.156828	2010-12-15 02:20:24.156828
174	RANKING_ID	1	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	PEOPLE_ID	14	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	EVENTS	0	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	SCORE	0	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	AVERAGE	0	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	PAID_VALUE	0	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	PRIZE_VALUE	0	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	BALANCE_VALUE	0	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	TOTAL_EVENTS	2	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	TOTAL_SCORE	70	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	TOTAL_PAID	20	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	TOTAL_PRIZE	50	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	TOTAL_BALANCE	30	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	TOTAL_AVERAGE	2.5	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
174	ENABLED	Sim	2010-12-15 02:20:24.186731	2010-12-15 02:20:24.186731
175	RANKING_ID	1	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	PEOPLE_ID	13	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	EVENTS	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	SCORE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	AVERAGE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	PAID_VALUE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	PRIZE_VALUE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	BALANCE_VALUE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	TOTAL_EVENTS	2	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	TOTAL_SCORE	20	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	TOTAL_PAID	20	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	TOTAL_PRIZE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	TOTAL_BALANCE	-20	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	TOTAL_AVERAGE	0	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
175	ENABLED	Sim	2010-12-15 02:20:24.200604	2010-12-15 02:20:24.200604
176	RANKING_ID	1	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	PEOPLE_ID	2	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	RANKING_DATE	2010-12-14	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	EVENTS	1	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	SCORE	10	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	AVERAGE	0	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	PAID_VALUE	10	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	PRIZE_VALUE	0	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	BALANCE_VALUE	-10	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	TOTAL_EVENTS	19	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	TOTAL_SCORE	463.79	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	TOTAL_PAID	220	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	TOTAL_PRIZE	317	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	TOTAL_BALANCE	97	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	TOTAL_AVERAGE	1.441	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
176	ENABLED	Sim	2010-12-15 02:20:24.216743	2010-12-15 02:20:24.216743
177	TOTAL_RANKING_POSITION	1	2010-12-15 02:20:24.235493	2010-12-15 02:20:24.235493
178	TOTAL_RANKING_POSITION	2	2010-12-15 02:20:24.247129	2010-12-15 02:20:24.247129
179	TOTAL_RANKING_POSITION	3	2010-12-15 02:20:24.264347	2010-12-15 02:20:24.264347
180	TOTAL_RANKING_POSITION	4	2010-12-15 02:20:24.273737	2010-12-15 02:20:24.273737
181	TOTAL_RANKING_POSITION	5	2010-12-15 02:20:24.285595	2010-12-15 02:20:24.285595
182	TOTAL_RANKING_POSITION	6	2010-12-15 02:20:24.302845	2010-12-15 02:20:24.302845
183	TOTAL_RANKING_POSITION	7	2010-12-15 02:20:24.312259	2010-12-15 02:20:24.312259
184	TOTAL_RANKING_POSITION	8	2010-12-15 02:20:24.330072	2010-12-15 02:20:24.330072
185	TOTAL_RANKING_POSITION	9	2010-12-15 02:20:24.342886	2010-12-15 02:20:24.342886
186	TOTAL_RANKING_POSITION	10	2010-12-15 02:20:24.347594	2010-12-15 02:20:24.347594
187	TOTAL_RANKING_POSITION	11	2010-12-15 02:20:24.371623	2010-12-15 02:20:24.371623
188	TOTAL_RANKING_POSITION	12	2010-12-15 02:20:24.377439	2010-12-15 02:20:24.377439
189	TOTAL_RANKING_POSITION	13	2010-12-15 02:20:24.382178	2010-12-15 02:20:24.382178
190	TOTAL_RANKING_POSITION	14	2010-12-15 02:20:24.386828	2010-12-15 02:20:24.386828
191	TOTAL_RANKING_POSITION	15	2010-12-15 02:20:24.392663	2010-12-15 02:20:24.392663
192	TOTAL_RANKING_POSITION	16	2010-12-15 02:20:24.410599	2010-12-15 02:20:24.410599
193	TOTAL_RANKING_POSITION	17	2010-12-15 02:20:24.41584	2010-12-15 02:20:24.41584
194	TOTAL_RANKING_POSITION	19	2010-12-15 02:20:24.42037	2010-12-15 02:20:24.42037
195	TOTAL_RANKING_POSITION	19	2010-12-15 02:20:24.425311	2010-12-15 02:20:24.425311
196	RANKING_POSITION	1	2010-12-15 02:20:24.434749	2010-12-15 02:20:24.434749
197	RANKING_POSITION	2	2010-12-15 02:20:24.439339	2010-12-15 02:20:24.439339
198	RANKING_POSITION	3	2010-12-15 02:20:24.443739	2010-12-15 02:20:24.443739
199	RANKING_POSITION	4	2010-12-15 02:20:24.449025	2010-12-15 02:20:24.449025
200	RANKING_POSITION	5	2010-12-15 02:20:24.475752	2010-12-15 02:20:24.475752
201	RANKING_POSITION	6	2010-12-15 02:20:24.582511	2010-12-15 02:20:24.582511
202	RANKING_POSITION	19	2010-12-15 02:20:24.61368	2010-12-15 02:20:24.61368
203	RANKING_POSITION	19	2010-12-15 02:20:24.621961	2010-12-15 02:20:24.621961
204	RANKING_POSITION	19	2010-12-15 02:20:24.628621	2010-12-15 02:20:24.628621
205	RANKING_POSITION	19	2010-12-15 02:20:24.664417	2010-12-15 02:20:24.664417
206	RANKING_POSITION	19	2010-12-15 02:20:24.680691	2010-12-15 02:20:24.680691
207	RANKING_POSITION	19	2010-12-15 02:20:24.686382	2010-12-15 02:20:24.686382
208	RANKING_POSITION	19	2010-12-15 02:20:24.691589	2010-12-15 02:20:24.691589
209	RANKING_POSITION	19	2010-12-15 02:20:24.706746	2010-12-15 02:20:24.706746
210	RANKING_POSITION	19	2010-12-15 02:20:24.717989	2010-12-15 02:20:24.717989
211	RANKING_POSITION	19	2010-12-15 02:20:24.723027	2010-12-15 02:20:24.723027
212	RANKING_POSITION	19	2010-12-15 02:20:24.728518	2010-12-15 02:20:24.728518
213	RANKING_POSITION	19	2010-12-15 02:20:24.737552	2010-12-15 02:20:24.737552
214	RANKING_POSITION	19	2010-12-15 02:20:24.742598	2010-12-15 02:20:24.742598
215	PLAYERS	1	2010-12-15 02:22:14.919772	2010-12-15 02:22:14.919772
216	INVITE_STATUS	yes	2010-12-15 02:22:14.92551	2010-12-15 02:22:14.92551
216	ENABLED	Sim	2010-12-15 02:22:14.92551	2010-12-15 02:22:14.92551
217	BUYIN	10	2010-12-15 02:22:14.931324	2010-12-15 02:22:14.931324
217	EVENT_POSITION	5	2010-12-15 02:22:14.931324	2010-12-15 02:22:14.931324
218	PLAYERS	2	2010-12-15 02:22:14.943024	2010-12-15 02:22:14.943024
219	INVITE_STATUS	yes	2010-12-15 02:22:14.947768	2010-12-15 02:22:14.947768
219	ENABLED	Sim	2010-12-15 02:22:14.947768	2010-12-15 02:22:14.947768
220	BUYIN	10	2010-12-15 02:22:14.954097	2010-12-15 02:22:14.954097
220	EVENT_POSITION	2	2010-12-15 02:22:14.954097	2010-12-15 02:22:14.954097
220	PRIZE	30	2010-12-15 02:22:14.954097	2010-12-15 02:22:14.954097
221	PLAYERS	3	2010-12-15 02:22:14.965548	2010-12-15 02:22:14.965548
222	INVITE_STATUS	yes	2010-12-15 02:22:14.980806	2010-12-15 02:22:14.980806
222	ENABLED	Sim	2010-12-15 02:22:14.980806	2010-12-15 02:22:14.980806
223	BUYIN	10	2010-12-15 02:22:14.991973	2010-12-15 02:22:14.991973
223	REBUY	10	2010-12-15 02:22:14.991973	2010-12-15 02:22:14.991973
223	EVENT_POSITION	4	2010-12-15 02:22:14.991973	2010-12-15 02:22:14.991973
224	PLAYERS	4	2010-12-15 02:22:15.000679	2010-12-15 02:22:15.000679
225	INVITE_STATUS	yes	2010-12-15 02:22:15.005532	2010-12-15 02:22:15.005532
225	ENABLED	Sim	2010-12-15 02:22:15.005532	2010-12-15 02:22:15.005532
226	BUYIN	10	2010-12-15 02:22:15.011109	2010-12-15 02:22:15.011109
226	EVENT_POSITION	6	2010-12-15 02:22:15.011109	2010-12-15 02:22:15.011109
227	PLAYERS	5	2010-12-15 02:22:15.021603	2010-12-15 02:22:15.021603
228	INVITE_STATUS	yes	2010-12-15 02:22:15.026851	2010-12-15 02:22:15.026851
228	ENABLED	Sim	2010-12-15 02:22:15.026851	2010-12-15 02:22:15.026851
229	BUYIN	10	2010-12-15 02:22:15.03199	2010-12-15 02:22:15.03199
229	REBUY	10	2010-12-15 02:22:15.03199	2010-12-15 02:22:15.03199
229	EVENT_POSITION	3	2010-12-15 02:22:15.03199	2010-12-15 02:22:15.03199
230	PLAYERS	6	2010-12-15 02:22:15.043093	2010-12-15 02:22:15.043093
231	INVITE_STATUS	yes	2010-12-15 02:22:15.048744	2010-12-15 02:22:15.048744
231	ENABLED	Sim	2010-12-15 02:22:15.048744	2010-12-15 02:22:15.048744
232	BUYIN	10	2010-12-15 02:22:15.066147	2010-12-15 02:22:15.066147
232	EVENT_POSITION	1	2010-12-15 02:22:15.066147	2010-12-15 02:22:15.066147
232	PRIZE	50	2010-12-15 02:22:15.066147	2010-12-15 02:22:15.066147
233	SAVED_RESULT	Sim	2010-12-15 02:22:15.073655	2010-12-15 02:22:15.073655
234	TOTAL_EVENTS	11	2010-12-15 02:22:15.12382	2010-12-15 02:22:15.12382
234	TOTAL_SCORE	172.37	2010-12-15 02:22:15.12382	2010-12-15 02:22:15.12382
234	TOTAL_PAID	120	2010-12-15 02:22:15.12382	2010-12-15 02:22:15.12382
234	TOTAL_BALANCE	-52	2010-12-15 02:22:15.12382	2010-12-15 02:22:15.12382
234	TOTAL_AVERAGE	0.567	2010-12-15 02:22:15.12382	2010-12-15 02:22:15.12382
235	TOTAL_EVENTS	2	2010-12-15 02:22:15.138866	2010-12-15 02:22:15.138866
235	TOTAL_SCORE	70	2010-12-15 02:22:15.138866	2010-12-15 02:22:15.138866
235	TOTAL_PAID	20	2010-12-15 02:22:15.138866	2010-12-15 02:22:15.138866
235	TOTAL_PRIZE	50	2010-12-15 02:22:15.138866	2010-12-15 02:22:15.138866
235	TOTAL_BALANCE	30	2010-12-15 02:22:15.138866	2010-12-15 02:22:15.138866
235	TOTAL_AVERAGE	2.5	2010-12-15 02:22:15.138866	2010-12-15 02:22:15.138866
236	TOTAL_EVENTS	20	2010-12-15 02:22:15.208917	2010-12-15 02:22:15.208917
236	TOTAL_SCORE	356.6	2010-12-15 02:22:15.208917	2010-12-15 02:22:15.208917
236	TOTAL_PAID	230	2010-12-15 02:22:15.208917	2010-12-15 02:22:15.208917
236	TOTAL_BALANCE	-50	2010-12-15 02:22:15.208917	2010-12-15 02:22:15.208917
236	TOTAL_AVERAGE	0.783	2010-12-15 02:22:15.208917	2010-12-15 02:22:15.208917
237	TOTAL_EVENTS	2	2010-12-15 02:22:15.221131	2010-12-15 02:22:15.221131
237	TOTAL_SCORE	60	2010-12-15 02:22:15.221131	2010-12-15 02:22:15.221131
237	TOTAL_PAID	20	2010-12-15 02:22:15.221131	2010-12-15 02:22:15.221131
237	TOTAL_BALANCE	20	2010-12-15 02:22:15.221131	2010-12-15 02:22:15.221131
237	TOTAL_AVERAGE	2	2010-12-15 02:22:15.221131	2010-12-15 02:22:15.221131
238	TOTAL_EVENTS	19	2010-12-15 02:22:15.23942	2010-12-15 02:22:15.23942
238	TOTAL_SCORE	345.99	2010-12-15 02:22:15.23942	2010-12-15 02:22:15.23942
238	TOTAL_PAID	240	2010-12-15 02:22:15.23942	2010-12-15 02:22:15.23942
238	TOTAL_BALANCE	-43	2010-12-15 02:22:15.23942	2010-12-15 02:22:15.23942
238	TOTAL_AVERAGE	0.821	2010-12-15 02:22:15.23942	2010-12-15 02:22:15.23942
239	TOTAL_EVENTS	20	2010-12-15 02:22:15.259712	2010-12-15 02:22:15.259712
239	TOTAL_SCORE	519.2	2010-12-15 02:22:15.259712	2010-12-15 02:22:15.259712
239	TOTAL_PAID	230	2010-12-15 02:22:15.259712	2010-12-15 02:22:15.259712
239	TOTAL_PRIZE	367	2010-12-15 02:22:15.259712	2010-12-15 02:22:15.259712
239	TOTAL_BALANCE	137	2010-12-15 02:22:15.259712	2010-12-15 02:22:15.259712
239	TOTAL_AVERAGE	1.596	2010-12-15 02:22:15.259712	2010-12-15 02:22:15.259712
240	RANKING_ID	1	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	PEOPLE_ID	8	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	EVENTS	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	SCORE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	AVERAGE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	PAID_VALUE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	PRIZE_VALUE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	BALANCE_VALUE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	TOTAL_EVENTS	1	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	TOTAL_SCORE	10	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	TOTAL_PAID	10	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	TOTAL_PRIZE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	TOTAL_BALANCE	-10	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	TOTAL_AVERAGE	0	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
240	ENABLED	Sim	2010-12-15 02:22:15.290748	2010-12-15 02:22:15.290748
241	RANKING_ID	1	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	PEOPLE_ID	9	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	EVENTS	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	SCORE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	AVERAGE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	PAID_VALUE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	PRIZE_VALUE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	BALANCE_VALUE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	TOTAL_EVENTS	4	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	TOTAL_SCORE	40	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	TOTAL_PAID	50	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	TOTAL_PRIZE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	TOTAL_BALANCE	-50	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	TOTAL_AVERAGE	0	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
241	ENABLED	Sim	2010-12-15 02:22:15.303647	2010-12-15 02:22:15.303647
242	RANKING_ID	1	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	PEOPLE_ID	3	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	EVENTS	0	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	SCORE	0	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	AVERAGE	0	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	PAID_VALUE	0	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	PRIZE_VALUE	0	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	BALANCE_VALUE	0	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	TOTAL_EVENTS	18	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	TOTAL_SCORE	396	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	TOTAL_PAID	190	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	TOTAL_PRIZE	228	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	TOTAL_BALANCE	38	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	TOTAL_AVERAGE	1.2	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
242	ENABLED	Sim	2010-12-15 02:22:15.329576	2010-12-15 02:22:15.329576
243	RANKING_ID	1	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	PEOPLE_ID	10	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	EVENTS	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	SCORE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	AVERAGE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	PAID_VALUE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	PRIZE_VALUE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	BALANCE_VALUE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	TOTAL_EVENTS	1	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	TOTAL_SCORE	10	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	TOTAL_PAID	10	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	TOTAL_PRIZE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	TOTAL_BALANCE	-10	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	TOTAL_AVERAGE	0	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
243	ENABLED	Sim	2010-12-15 02:22:15.342947	2010-12-15 02:22:15.342947
244	RANKING_ID	1	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	PEOPLE_ID	7	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	EVENTS	2	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	SCORE	20	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	AVERAGE	0	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	PAID_VALUE	20	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	PRIZE_VALUE	0	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	BALANCE_VALUE	-20	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	TOTAL_EVENTS	11	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	TOTAL_SCORE	172.37	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	TOTAL_PAID	120	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	TOTAL_PRIZE	68	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	TOTAL_BALANCE	-52	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	TOTAL_AVERAGE	0.567	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
244	ENABLED	Sim	2010-12-15 02:22:15.356268	2010-12-15 02:22:15.356268
245	RANKING_ID	1	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	PEOPLE_ID	19	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	EVENTS	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	SCORE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	AVERAGE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	PAID_VALUE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	PRIZE_VALUE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	BALANCE_VALUE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	TOTAL_EVENTS	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	TOTAL_SCORE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	TOTAL_PAID	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	TOTAL_PRIZE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	TOTAL_BALANCE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	TOTAL_AVERAGE	0	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
245	ENABLED	Sim	2010-12-15 02:22:15.381463	2010-12-15 02:22:15.381463
246	RANKING_ID	1	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	PEOPLE_ID	20	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	EVENTS	2	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	SCORE	70	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	AVERAGE	2.5	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	PAID_VALUE	20	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	PRIZE_VALUE	50	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	BALANCE_VALUE	30	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	TOTAL_EVENTS	2	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	TOTAL_SCORE	70	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	TOTAL_PAID	20	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	TOTAL_PRIZE	50	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	TOTAL_BALANCE	30	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	TOTAL_AVERAGE	2.5	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
246	ENABLED	Sim	2010-12-15 02:22:15.41229	2010-12-15 02:22:15.41229
247	RANKING_ID	1	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	PEOPLE_ID	18	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	EVENTS	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	SCORE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	AVERAGE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	PAID_VALUE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	PRIZE_VALUE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	BALANCE_VALUE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	TOTAL_EVENTS	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	TOTAL_SCORE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	TOTAL_PAID	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	TOTAL_PRIZE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	TOTAL_BALANCE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	TOTAL_AVERAGE	0	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
247	ENABLED	Sim	2010-12-15 02:22:15.457494	2010-12-15 02:22:15.457494
248	RANKING_ID	1	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	PEOPLE_ID	5	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	EVENTS	0	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	SCORE	0	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	AVERAGE	0	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	PAID_VALUE	0	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	PRIZE_VALUE	0	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	BALANCE_VALUE	0	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	TOTAL_EVENTS	12	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	TOTAL_SCORE	176.04	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	TOTAL_PAID	150	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	TOTAL_PRIZE	70	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	TOTAL_BALANCE	-80	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	TOTAL_AVERAGE	0.467	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
248	ENABLED	Sim	2010-12-15 02:22:15.471852	2010-12-15 02:22:15.471852
249	RANKING_ID	1	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	PEOPLE_ID	6	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	EVENTS	0	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	SCORE	0	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	AVERAGE	0	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	PAID_VALUE	0	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	PRIZE_VALUE	0	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	BALANCE_VALUE	0	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	TOTAL_EVENTS	16	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	TOTAL_SCORE	362.08	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	TOTAL_PAID	190	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	TOTAL_PRIZE	240	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	TOTAL_BALANCE	50	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	TOTAL_AVERAGE	1.263	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
249	ENABLED	Sim	2010-12-15 02:22:15.484875	2010-12-15 02:22:15.484875
250	RANKING_ID	1	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	PEOPLE_ID	1	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	EVENTS	2	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	SCORE	20	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	AVERAGE	0	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	PAID_VALUE	30	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	PRIZE_VALUE	0	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	BALANCE_VALUE	-30	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	TOTAL_EVENTS	20	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	TOTAL_SCORE	356.6	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	TOTAL_PAID	230	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	TOTAL_PRIZE	180	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	TOTAL_BALANCE	-50	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	TOTAL_AVERAGE	0.783	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
250	ENABLED	Sim	2010-12-15 02:22:15.502705	2010-12-15 02:22:15.502705
251	RANKING_ID	1	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	PEOPLE_ID	17	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	EVENTS	2	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	SCORE	60	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	AVERAGE	2	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	PAID_VALUE	20	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	PRIZE_VALUE	40	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	BALANCE_VALUE	20	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	TOTAL_EVENTS	2	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	TOTAL_SCORE	60	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	TOTAL_PAID	20	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	TOTAL_PRIZE	40	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	TOTAL_BALANCE	20	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	TOTAL_AVERAGE	2	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
251	ENABLED	Sim	2010-12-15 02:22:15.51369	2010-12-15 02:22:15.51369
252	RANKING_ID	1	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	PEOPLE_ID	11	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	EVENTS	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	SCORE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	AVERAGE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	PAID_VALUE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	PRIZE_VALUE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	BALANCE_VALUE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	TOTAL_EVENTS	2	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	TOTAL_SCORE	20	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	TOTAL_PAID	20	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	TOTAL_PRIZE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	TOTAL_BALANCE	-20	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	TOTAL_AVERAGE	0	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
252	ENABLED	Sim	2010-12-15 02:22:15.526415	2010-12-15 02:22:15.526415
253	RANKING_ID	1	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	PEOPLE_ID	12	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	EVENTS	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	SCORE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	AVERAGE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	PAID_VALUE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	PRIZE_VALUE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	BALANCE_VALUE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	TOTAL_EVENTS	2	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	TOTAL_SCORE	20	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	TOTAL_PAID	20	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	TOTAL_PRIZE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	TOTAL_BALANCE	-20	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	TOTAL_AVERAGE	0	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
253	ENABLED	Sim	2010-12-15 02:22:15.544396	2010-12-15 02:22:15.544396
254	RANKING_ID	1	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	PEOPLE_ID	4	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	EVENTS	2	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	SCORE	20	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	AVERAGE	0	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	PAID_VALUE	30	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	PRIZE_VALUE	0	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	BALANCE_VALUE	-30	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	TOTAL_EVENTS	19	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	TOTAL_SCORE	345.99	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	TOTAL_PAID	240	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	TOTAL_PRIZE	197	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	TOTAL_BALANCE	-43	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	TOTAL_AVERAGE	0.821	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
254	ENABLED	Sim	2010-12-15 02:22:15.556113	2010-12-15 02:22:15.556113
255	RANKING_ID	1	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	PEOPLE_ID	15	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	EVENTS	0	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	SCORE	0	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	AVERAGE	0	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	PAID_VALUE	0	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	PRIZE_VALUE	0	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	BALANCE_VALUE	0	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	TOTAL_EVENTS	4	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	TOTAL_SCORE	120	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	TOTAL_PAID	40	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	TOTAL_PRIZE	80	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	TOTAL_BALANCE	40	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	TOTAL_AVERAGE	2	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
255	ENABLED	Sim	2010-12-15 02:22:15.569076	2010-12-15 02:22:15.569076
256	RANKING_ID	1	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	PEOPLE_ID	14	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	EVENTS	0	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	SCORE	0	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	AVERAGE	0	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	PAID_VALUE	0	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	PRIZE_VALUE	0	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	BALANCE_VALUE	0	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	TOTAL_EVENTS	2	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	TOTAL_SCORE	70	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	TOTAL_PAID	20	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	TOTAL_PRIZE	50	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	TOTAL_BALANCE	30	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	TOTAL_AVERAGE	2.5	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
256	ENABLED	Sim	2010-12-15 02:22:15.581651	2010-12-15 02:22:15.581651
257	RANKING_ID	1	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	PEOPLE_ID	13	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	EVENTS	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	SCORE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	AVERAGE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	PAID_VALUE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	PRIZE_VALUE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	BALANCE_VALUE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	TOTAL_EVENTS	2	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	TOTAL_SCORE	20	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	TOTAL_PAID	20	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	TOTAL_PRIZE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	TOTAL_BALANCE	-20	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	TOTAL_AVERAGE	0	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
257	ENABLED	Sim	2010-12-15 02:22:15.594832	2010-12-15 02:22:15.594832
258	RANKING_ID	1	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	PEOPLE_ID	2	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	RANKING_DATE	2010-12-14	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	EVENTS	2	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	SCORE	70	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	AVERAGE	2.5	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	PAID_VALUE	20	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	PRIZE_VALUE	50	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	BALANCE_VALUE	30	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	TOTAL_EVENTS	20	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	TOTAL_SCORE	519.2	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	TOTAL_PAID	230	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	TOTAL_PRIZE	367	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	TOTAL_BALANCE	137	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	TOTAL_AVERAGE	1.596	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
258	ENABLED	Sim	2010-12-15 02:22:15.606678	2010-12-15 02:22:15.606678
259	TOTAL_RANKING_POSITION	1	2010-12-15 02:22:15.621052	2010-12-15 02:22:15.621052
260	TOTAL_RANKING_POSITION	2	2010-12-15 02:22:15.626302	2010-12-15 02:22:15.626302
261	TOTAL_RANKING_POSITION	3	2010-12-15 02:22:15.631044	2010-12-15 02:22:15.631044
262	TOTAL_RANKING_POSITION	4	2010-12-15 02:22:15.635889	2010-12-15 02:22:15.635889
263	TOTAL_RANKING_POSITION	5	2010-12-15 02:22:15.640229	2010-12-15 02:22:15.640229
264	TOTAL_RANKING_POSITION	6	2010-12-15 02:22:15.645365	2010-12-15 02:22:15.645365
265	TOTAL_RANKING_POSITION	7	2010-12-15 02:22:15.650258	2010-12-15 02:22:15.650258
266	TOTAL_RANKING_POSITION	8	2010-12-15 02:22:15.667907	2010-12-15 02:22:15.667907
267	TOTAL_RANKING_POSITION	9	2010-12-15 02:22:15.672699	2010-12-15 02:22:15.672699
268	TOTAL_RANKING_POSITION	10	2010-12-15 02:22:15.677402	2010-12-15 02:22:15.677402
269	TOTAL_RANKING_POSITION	11	2010-12-15 02:22:15.68234	2010-12-15 02:22:15.68234
270	TOTAL_RANKING_POSITION	12	2010-12-15 02:22:15.686891	2010-12-15 02:22:15.686891
271	TOTAL_RANKING_POSITION	13	2010-12-15 02:22:15.691827	2010-12-15 02:22:15.691827
272	TOTAL_RANKING_POSITION	14	2010-12-15 02:22:15.696519	2010-12-15 02:22:15.696519
273	TOTAL_RANKING_POSITION	15	2010-12-15 02:22:15.701916	2010-12-15 02:22:15.701916
274	TOTAL_RANKING_POSITION	16	2010-12-15 02:22:15.707965	2010-12-15 02:22:15.707965
275	TOTAL_RANKING_POSITION	17	2010-12-15 02:22:15.713316	2010-12-15 02:22:15.713316
276	TOTAL_RANKING_POSITION	19	2010-12-15 02:22:15.719686	2010-12-15 02:22:15.719686
277	TOTAL_RANKING_POSITION	19	2010-12-15 02:22:15.728969	2010-12-15 02:22:15.728969
278	RANKING_POSITION	1	2010-12-15 02:22:15.745436	2010-12-15 02:22:15.745436
279	RANKING_POSITION	2	2010-12-15 02:22:15.758265	2010-12-15 02:22:15.758265
280	RANKING_POSITION	3	2010-12-15 02:22:15.764673	2010-12-15 02:22:15.764673
281	RANKING_POSITION	4	2010-12-15 02:22:15.769295	2010-12-15 02:22:15.769295
282	RANKING_POSITION	5	2010-12-15 02:22:15.809303	2010-12-15 02:22:15.809303
283	RANKING_POSITION	6	2010-12-15 02:22:15.83504	2010-12-15 02:22:15.83504
284	RANKING_POSITION	19	2010-12-15 02:22:15.864553	2010-12-15 02:22:15.864553
285	RANKING_POSITION	19	2010-12-15 02:22:15.881789	2010-12-15 02:22:15.881789
286	RANKING_POSITION	19	2010-12-15 02:22:15.915804	2010-12-15 02:22:15.915804
287	RANKING_POSITION	19	2010-12-15 02:22:15.949318	2010-12-15 02:22:15.949318
288	RANKING_POSITION	19	2010-12-15 02:22:15.968935	2010-12-15 02:22:15.968935
289	RANKING_POSITION	19	2010-12-15 02:22:15.980413	2010-12-15 02:22:15.980413
290	RANKING_POSITION	19	2010-12-15 02:22:16.005402	2010-12-15 02:22:16.005402
291	RANKING_POSITION	19	2010-12-15 02:22:16.038519	2010-12-15 02:22:16.038519
292	RANKING_POSITION	19	2010-12-15 02:22:16.063794	2010-12-15 02:22:16.063794
293	RANKING_POSITION	19	2010-12-15 02:22:16.078998	2010-12-15 02:22:16.078998
294	RANKING_POSITION	19	2010-12-15 02:22:16.117592	2010-12-15 02:22:16.117592
295	RANKING_POSITION	19	2010-12-15 02:22:16.14632	2010-12-15 02:22:16.14632
296	RANKING_POSITION	19	2010-12-15 02:22:16.169303	2010-12-15 02:22:16.169303
297	ALLOW_EDIT	Sim	2010-12-15 12:14:37.635925	2010-12-15 12:14:37.635925
298	ALLOW_EDIT	Não	2010-12-15 12:14:47.321248	2010-12-15 12:14:47.321248
299	ALLOW_EDIT	Não	2010-12-15 12:16:24.85935	2010-12-15 12:16:24.85935
300	ALLOW_EDIT	Não	2010-12-15 12:16:40.58439	2010-12-15 12:16:40.58439
301	EVENT_ID	24	2010-12-16 03:10:21.910377	2010-12-16 03:10:21.910377
301	PEOPLE_ID	1	2010-12-16 03:10:21.910377	2010-12-16 03:10:21.910377
301	COMMENT	Alô alô, testando nova funcionalidade de comentários dentro dos eventos\nQuem receber o e-mail da um reply ;)\nAguardando o poker da virada!!!	2010-12-16 03:10:21.910377	2010-12-16 03:10:21.910377
302	INVITES	19	2010-12-16 03:10:48.339844	2010-12-16 03:10:48.339844
303	EVENT_ID	24	2010-12-16 08:10:20.910478	2010-12-16 08:10:20.910478
303	PEOPLE_ID	6	2010-12-16 08:10:20.910478	2010-12-16 08:10:20.910478
303	COMMENT	tah muito profissa esse site aki.\n\nmas o reply q vc pediu eh por aqui certo?\n\nabs	2010-12-16 08:10:20.910478	2010-12-16 08:10:20.910478
304	EVENT_ID	24	2010-12-16 10:14:52.119695	2010-12-16 10:14:52.119695
304	PEOPLE_ID	4	2010-12-16 10:14:52.119695	2010-12-16 10:14:52.119695
304	COMMENT	Aewewew.. poker da viradaaaaaaaaaa... seus pato, vou ganhar tudo e descontar pelo ano todo auhhuahuahuahua! :P	2010-12-16 10:14:52.119695	2010-12-16 10:14:52.119695
\.


--
-- Data for Name: people; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY people (id, people_type_id, first_name, last_name, full_name, email_address, birthday, enabled, visible, locked, deleted, created_at, updated_at) FROM stdin;
1	2	Luciano	Stegun	Luciano Stegun	lucianostegun@gmail.com	\N	t	t	f	f	2010-11-16 00:38:31	2010-11-16 00:38:31
8	3	Alan		Alan	alan.frazeto@hotmail.com	\N	t	t	f	f	2010-11-16 12:42:23	2010-11-16 12:42:23
2	3	Wagner	André	Wagner André	omegalinux@gmail.com	\N	t	t	f	f	2010-11-16 00:40:22	2010-11-16 00:40:22
3	2	Diogo	Nunes	Diogo Nunes	diogownunes@gmail.com	\N	t	t	f	f	2010-11-16 00:40:32	2010-11-29 14:18:09
9	2	Daniel	Motta	Daniel Motta	danmotta2@gmail.com	\N	t	t	f	f	2010-11-16 12:42:34	2010-11-16 12:42:34
4	2	Reynaldo	Rancan Junior	Reynaldo Rancan Junior	rrancan@gmail.com	\N	t	t	f	f	2010-11-16 00:40:44	2010-11-24 10:52:18
5	2	Kauê	Carbonari	Kauê Carbonari	kaue.q.carbonari@accenture.com	\N	t	t	f	f	2010-11-16 00:40:57	2010-11-23 20:35:54
10	3	Eduardo	Sampaio	Eduardo Sampaio	esampaio@vexcorp.com	\N	t	t	f	f	2010-11-16 12:43:11	2010-11-16 12:43:11
6	2	Leo	Watanabe	Leo Watanabe	leo.watanabe@accenture.com	\N	t	t	f	f	2010-11-16 00:41:08	2010-11-24 13:26:28
7	2	Fabio	Parrilha	Fabio Parrilha	fparrilha@yahoo.com.br	\N	t	t	f	f	2010-11-16 00:41:23	2010-11-25 18:14:19
11	2	Marcelo	Marcon	Marcelo Marcon	marcelomarcon@hotmail.com	\N	t	t	f	f	2010-11-16 12:43:52	2010-11-24 11:07:01
16	2	Carlos	Sartorelli	Carlos Sartorelli	csartore@uol.com.br	\N	t	t	f	f	2010-11-24 17:55:11	2010-11-24 17:55:11
12	3	Renato		Renato	cobaltonitrito@yahoo.com.br	\N	t	t	f	f	2010-11-16 12:44:14	2010-11-16 12:44:14
13	3	Vitor		Vitor	vitor@gmail.com	\N	t	t	f	f	2010-11-16 12:44:29	2010-11-16 12:44:29
14	3	Tio Rey		Tio Rey	tiorey@gmail.com	\N	t	t	f	f	2010-11-16 12:44:54	2010-11-16 12:44:54
15	3	Saichi	Okuma	Saichi Okuma	saichi.okuma@accenture.com	\N	t	t	f	f	2010-11-16 12:45:35	2010-11-16 12:45:35
19	2	Flavio	Fernandes	Flavio Fernandes	fnf@aasp.org.br	\N	t	t	f	f	2010-12-12 19:10:12	2010-12-12 19:10:12
20	2	Guilherme	Limpo	Guilherme Limpo	guilhermelimpo@gmail.com	\N	t	t	f	f	2010-12-15 02:13:06	2010-12-15 11:13:42
17	2	Marcelo	Albuquerque	Marcelo Albuquerque	marceloaqsantos@gmail.com	\N	t	t	f	f	2010-12-06 18:29:33	2010-12-07 09:37:18
18	3	João	Marcelo	João Marcelo	82.jmms@gmail.com	\N	t	t	f	f	2010-12-06 18:30:27	2010-12-06 18:30:27
\.


--
-- Data for Name: ranking; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY ranking (id, ranking_name, user_site_id, ranking_type_id, start_date, finish_date, is_private, players, events, enabled, visible, locked, deleted, created_at, updated_at, default_buyin, game_style_id) FROM stdin;
1	Poker friends - NLHE	1	12	2010-01-01	\N	t	19	20	t	t	f	f	2010-11-16 00:38:51	2010-12-15 02:18:09	10	8
2	Poker friends - Ring	1	13	2010-08-17	2010-12-31	f	8	5	t	t	f	f	2010-11-16 17:14:40	2010-11-24 12:35:13	10	9
3	\N	2	\N	\N	\N	f	0	0	f	f	f	f	2010-12-15 02:08:19	2010-12-15 02:08:19	0	\N
\.


--
-- Data for Name: ranking_history; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY ranking_history (ranking_id, people_id, ranking_date, events, score, ranking_position, balance_value, prize_value, paid_value, total_ranking_position, total_events, total_score, total_balance, total_prize, total_paid, enabled, created_at, updated_at, average, total_average) FROM stdin;
2	9	2010-08-17	1	22.75	2	5.5	25.5	20	2	1	22.75	5.5	25.5	20	t	2010-12-09 01:35:18	2010-12-09 01:35:18	1.275	1.275
2	3	2010-08-17	1	20.00	3	0	10	10	3	1	20.00	0	10	10	t	2010-12-09 01:35:18	2010-12-09 01:35:18	1.000	1.000
2	7	2010-08-17	0	0.00	8	0	0	0	8	0	0.00	0	0	0	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	5	2010-08-17	0	0.00	8	0	0	0	8	0	0.00	0	0	0	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	6	2010-08-17	0	0.00	8	0	0	0	8	0	0.00	0	0	0	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	1	2010-08-17	0	0.00	8	0	0	0	8	0	0.00	0	0	0	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	4	2010-08-17	1	13.00	4	-14	6	20	4	1	13.00	-14	6	20	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.300	0.300
2	2	2010-08-17	1	28.50	1	8.5	18.5	10	1	1	28.50	8.5	18.5	10	t	2010-12-09 01:35:18	2010-12-09 01:35:18	1.850	1.850
1	12	2010-12-07	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	4	2010-12-07	2	20.00	4	-20	0	20	5	17	329.46	-13	197	210	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.938
1	15	2010-12-07	0	0.00	17	0	0	0	8	4	120.00	40	80	40	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	2.000
1	14	2010-12-07	0	0.00	17	0	0	0	9	2	70.00	30	50	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	2.500
1	13	2010-12-07	0	0.00	17	0	0	0	13	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	2	2010-12-07	2	100.00	1	60	80	20	1	18	451.80	107	317	210	t	2010-12-09 01:34:38	2010-12-09 01:34:38	4.000	1.510
1	3	2010-12-07	2	20.00	5	-30	0	30	2	18	396.00	38	228	190	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	1.200
1	6	2010-12-07	2	20.00	3	-20	0	20	3	16	362.08	50	240	190	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	1.263
1	1	2010-12-07	2	66.66	2	40	70	30	4	18	342.00	-20	180	200	t	2010-12-09 01:34:38	2010-12-09 01:34:38	2.333	0.900
1	5	2010-12-07	0	0.00	17	0	0	0	6	12	176.04	-80	70	150	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.467
1	7	2010-12-07	0	0.00	17	0	0	0	7	9	151.20	-32	68	100	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.680
1	9	2010-12-07	2	20.00	6	-30	0	30	10	4	40.00	-50	0	50	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	11	2010-12-07	0	0.00	17	0	0	0	11	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	8	2010-12-07	0	0.00	17	0	0	0	14	1	10.00	-10	0	10	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	10	2010-12-07	0	0.00	17	0	0	0	15	1	10.00	-10	0	10	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	17	2010-12-07	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
2	9	2010-09-08	0	0.00	8	0	0	0	3	1	22.75	5.5	25.5	20	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	1.275
2	3	2010-09-08	1	10.00	3	-10	0	10	4	2	30.00	-10	10	20	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.500
2	7	2010-09-08	0	0.00	8	0	0	0	8	0	0.00	0	0	0	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	5	2010-09-08	0	0.00	8	0	0	0	8	0	0.00	0	0	0	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	6	2010-09-08	1	10.00	5	-20	0	20	5	1	10.00	-20	0	20	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.000
2	1	2010-09-08	1	31.00	2	11	21	10	2	1	31.00	11	21	10	t	2010-12-09 01:35:18	2010-12-09 01:35:18	2.100	2.100
2	4	2010-09-08	1	10.00	4	-20	0	20	6	2	23.00	-34	6	40	t	2010-12-09 01:35:18	2010-12-09 01:35:18	0.000	0.150
2	2	2010-09-08	1	59.00	1	39	49	10	1	2	87.50	47.5	67.5	20	t	2010-12-09 01:35:18	2010-12-09 01:35:18	4.900	3.375
1	18	2010-12-07	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	7	2010-11-23	0	0.00	17	0	0	0	7	9	151.20	-32	68	100	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.680
1	15	2010-11-23	0	0.00	17	0	0	0	8	4	120.00	40	80	40	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	2.000
1	14	2010-11-23	0	0.00	17	0	0	0	9	2	70.00	30	50	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	2.500
1	9	2010-11-23	0	0.00	17	0	0	0	10	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	11	2010-11-23	0	0.00	17	0	0	0	11	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	12	2010-11-23	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	13	2010-11-23	0	0.00	17	0	0	0	13	2	20.00	-20	0	20	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	8	2010-11-23	0	0.00	17	0	0	0	14	1	10.00	-10	0	10	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	10	2010-11-23	0	0.00	17	0	0	0	15	1	10.00	-10	0	10	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	17	2010-11-23	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	18	2010-11-23	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.000
1	3	2010-11-23	1	43.00	1	23	33	10	1	16	388.00	68	228	160	t	2010-12-09 01:34:38	2010-12-09 01:34:38	3.300	1.425
1	4	2010-11-23	1	32.00	2	12	22	10	4	15	305.55	7	197	190	t	2010-12-09 01:34:38	2010-12-09 01:34:38	2.200	1.037
1	6	2010-11-23	1	28.33	3	25	55	30	3	14	337.68	70	240	170	t	2010-12-09 01:34:38	2010-12-09 01:34:38	1.833	1.412
1	2	2010-11-23	1	10.00	4	-20	0	20	2	16	359.52	47	237	190	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	1.247
2	9	2010-10-05	0	0.00	8	0	0	0	3	1	22.75	5.5	25.5	20	t	2010-12-09 01:35:18	2010-12-09 01:35:19	0.000	1.275
2	3	2010-10-05	1	21.07	4	0.75	7.75	7	4	3	49.71	-9.25	17.75	27	t	2010-12-09 01:35:18	2010-12-09 01:35:19	1.107	0.657
2	7	2010-10-05	1	10.00	6	-20	0	20	7	1	10.00	-20	0	20	t	2010-12-09 01:35:18	2010-12-09 01:35:19	0.000	0.000
2	5	2010-10-05	1	10.00	5	-20	0	20	6	1	10.00	-20	0	20	t	2010-12-09 01:35:18	2010-12-09 01:35:19	0.000	0.000
2	6	2010-10-05	1	22.25	3	2.25	12.25	10	5	2	28.16	-17.75	12.25	30	t	2010-12-09 01:35:18	2010-12-09 01:35:19	1.225	0.408
1	2	2010-08-10	2	115.00	1	75	95	20	1	2	115.00	75	95	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	4.750	4.750
2	1	2010-10-05	1	50.85	1	30.850000000000001	40.850000000000001	10	2	2	81.86	41.850000000000001	61.850000000000001	20	t	2010-12-09 01:35:18	2010-12-09 01:35:19	4.085	3.093
2	4	2010-10-05	0	0.00	8	0	0	0	8	2	23.00	-34	6	40	t	2010-12-09 01:35:18	2010-12-09 01:35:19	0.000	0.150
2	2	2010-10-05	1	23.08	2	6.1500000000000004	26.149999999999999	20	1	3	100.23	53.649999999999999	93.650000000000006	40	t	2010-12-09 01:35:18	2010-12-09 01:35:19	1.308	2.341
1	1	2010-11-23	1	10.00	5	-20	0	20	5	16	263.52	-60	110	170	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.647
1	5	2010-11-23	1	10.00	6	-20	0	20	6	12	176.04	-80	70	150	t	2010-12-09 01:34:38	2010-12-09 01:34:38	0.000	0.467
1	15	2010-11-09	0	0.00	17	0	0	0	8	4	120.00	40	80	40	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	2.000
1	7	2010-11-09	0	0.00	17	0	0	0	7	9	151.20	-32	68	100	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.680
1	3	2010-08-10	2	50.00	2	10	30	20	2	2	50.00	10	30	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	1.500	1.500
1	14	2010-11-09	0	0.00	17	0	0	0	9	2	70.00	30	50	20	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	2.500
1	8	2010-11-09	0	0.00	17	0	0	0	14	1	10.00	-10	0	10	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	15	2010-08-10	2	50.00	3	10	30	20	3	2	50.00	10	30	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	1.500	1.500
1	6	2010-08-10	2	35.00	4	-5	15	20	4	2	35.00	-5	15	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.750	0.750
1	10	2010-11-09	0	0.00	17	0	0	0	15	1	10.00	-10	0	10	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	4	2010-08-10	2	30.00	5	-20	20	40	5	2	30.00	-20	20	40	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.500	0.500
1	1	2010-08-10	2	20.00	6	-20	0	20	6	2	20.00	-20	0	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	5	2010-08-10	2	20.00	7	-20	0	20	7	2	20.00	-20	0	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	7	2010-08-10	2	20.00	8	-20	0	20	8	2	20.00	-20	0	20	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	10	2010-08-10	1	10.00	9	-10	0	10	9	1	10.00	-10	0	10	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	17	2010-08-10	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	18	2010-08-10	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	8	2010-08-10	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	9	2010-08-10	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	11	2010-08-10	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	12	2010-08-10	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	13	2010-08-10	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	14	2010-08-10	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:35	0.000	0.000
1	9	2010-11-09	0	0.00	17	0	0	0	10	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	11	2010-11-09	0	0.00	17	0	0	0	11	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	12	2010-11-09	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	13	2010-11-09	0	0.00	17	0	0	0	13	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	4	2010-11-09	2	20.00	5	-20	0	20	4	14	276.08	-5	175	180	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.972
1	2	2010-11-09	2	45.00	3	5	25	20	1	15	359.10	67	237	170	t	2010-12-09 01:34:37	2010-12-09 01:34:38	1.250	1.394
1	3	2010-11-09	2	65.00	1	25	45	20	2	15	345.00	45	195	150	t	2010-12-09 01:34:37	2010-12-09 01:34:38	2.250	1.300
1	6	2010-11-09	2	45.00	4	5	25	20	3	13	301.73	45	185	140	t	2010-12-09 01:34:37	2010-12-09 01:34:38	1.250	1.321
1	1	2010-11-09	2	65.00	2	25	45	20	5	15	259.95	-40	110	150	t	2010-12-09 01:34:37	2010-12-09 01:34:38	2.250	0.733
1	5	2010-11-09	2	20.00	6	-40	0	40	6	11	169.18	-60	70	130	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.538
1	17	2010-11-09	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	18	2010-11-09	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:37	2010-12-09 01:34:38	0.000	0.000
1	13	2010-10-26	0	0.00	17	0	0	0	13	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	8	2010-10-26	0	0.00	17	0	0	0	14	1	10.00	-10	0	10	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	10	2010-10-26	0	0.00	17	0	0	0	15	1	10.00	-10	0	10	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	17	2010-10-26	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
2	2	2010-10-26	1	10.00	5	-20	0	20	2	4	102.44	33.649999999999999	93.650000000000006	60	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	1.561
2	1	2010-10-26	1	46.00	1	26	36	10	1	3	127.86	67.849999999999994	97.849999999999994	30	t	2010-12-09 01:35:19	2010-12-09 01:35:19	3.600	3.262
1	18	2010-10-26	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
2	9	2010-10-26	0	0.00	8	0	0	0	3	1	22.75	5.5	25.5	20	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	1.275
2	3	2010-10-26	1	34.00	2	14	24	10	4	4	85.12	4.75	41.75	37	t	2010-12-09 01:35:19	2010-12-09 01:35:19	2.400	1.128
1	2	2010-08-24	2	38.00	5	-3	27	30	1	4	137.60	72	122	50	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.900	2.440
2	5	2010-10-26	0	0.00	8	0	0	0	5	1	10.00	-20	0	20	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	0.000
1	15	2010-08-24	2	70.00	1	30	50	20	2	4	120.00	40	80	40	t	2010-12-09 01:34:35	2010-12-09 01:34:36	2.500	2.000
2	7	2010-10-26	0	0.00	8	0	0	0	6	1	10.00	-20	0	20	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	0.000
2	6	2010-10-26	1	15.00	3	-10	10	20	7	3	43.35	-27.75	22.25	50	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.500	0.445
1	3	2010-08-24	2	65.00	2	25	45	20	3	4	115.00	35	75	40	t	2010-12-09 01:34:35	2010-12-09 01:34:36	2.250	1.875
2	4	2010-10-26	1	10.00	4	-10	0	10	8	3	33.60	-44	6	50	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	0.120
1	4	2010-10-26	2	60.00	1	20	40	20	4	12	251.28	15	175	160	t	2010-12-09 01:34:37	2010-12-09 01:34:37	2.000	1.094
1	3	2010-10-26	2	60.00	2	20	40	20	2	13	280.02	20	150	130	t	2010-12-09 01:34:37	2010-12-09 01:34:37	2.000	1.154
1	6	2010-08-24	2	40.00	3	0	30	30	4	4	76.00	-5	45	50	t	2010-12-09 01:34:35	2010-12-09 01:34:36	1.000	0.900
1	1	2010-08-24	2	40.00	4	0	20	20	5	4	60.00	-20	20	40	t	2010-12-09 01:34:35	2010-12-09 01:34:36	1.000	0.500
1	2	2010-10-26	2	40.00	3	0	20	20	1	13	313.69	62	212	150	t	2010-12-09 01:34:37	2010-12-09 01:34:37	1.000	1.413
1	6	2010-10-26	2	40.00	4	0	20	20	3	11	256.63	40	160	120	t	2010-12-09 01:34:37	2010-12-09 01:34:37	1.000	1.333
1	7	2010-08-24	2	38.00	6	-2	18	20	6	4	58.00	-22	18	40	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.900	0.450
1	5	2010-10-26	2	20.00	5	-20	0	20	6	9	160.02	-20	70	90	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.778
1	1	2010-10-26	2	20.00	6	-20	0	20	5	13	195.00	-65	65	130	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.500
1	4	2010-08-24	2	20.00	8	-40	0	40	7	4	50.00	-60	20	80	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.250
1	5	2010-08-24	2	20.00	7	-20	0	20	8	4	40.00	-40	0	40	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	10	2010-08-24	0	0.00	17	0	0	0	9	1	10.00	-10	0	10	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	8	2010-08-24	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	9	2010-08-24	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	11	2010-08-24	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	12	2010-08-24	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	13	2010-08-24	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	14	2010-08-24	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	17	2010-08-24	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	18	2010-08-24	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:35	2010-12-09 01:34:36	0.000	0.000
1	15	2010-10-26	0	0.00	17	0	0	0	8	4	120.00	40	80	40	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	2.000
1	7	2010-10-26	0	0.00	17	0	0	0	7	9	151.20	-32	68	100	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.680
1	14	2010-10-26	0	0.00	17	0	0	0	9	2	70.00	30	50	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	2.500
1	9	2010-10-26	0	0.00	17	0	0	0	10	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	11	2010-10-26	0	0.00	17	0	0	0	11	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	12	2010-10-26	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	12	2010-10-19	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	13	2010-10-19	0	0.00	17	0	0	0	13	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	2	2010-10-19	2	20.00	8	-30	0	30	1	11	272.47	62	192	130	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	1.477
1	3	2010-10-19	2	35.00	4	-5	15	20	2	11	220.00	0	110	110	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.750	1.000
1	6	2010-10-19	2	65.00	2	25	45	20	3	9	216.00	40	140	100	t	2010-12-09 01:34:37	2010-12-09 01:34:37	2.250	1.400
1	4	2010-10-19	2	45.00	3	5	25	20	4	10	196.40	-5	135	140	t	2010-12-09 01:34:37	2010-12-09 01:34:37	1.250	0.964
1	1	2010-10-19	2	20.00	6	-20	0	20	5	11	175.01	-45	65	110	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.591
1	7	2010-10-19	2	35.00	5	-5	15	20	6	9	151.20	-32	68	100	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.750	0.680
1	5	2010-10-19	2	90.00	1	50	70	20	7	7	140.00	0	70	70	t	2010-12-09 01:34:37	2010-12-09 01:34:37	3.500	1.000
1	15	2010-10-19	0	0.00	17	0	0	0	8	4	120.00	40	80	40	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	2.000
2	5	2010-11-23	1	10.00	4	-10	0	10	6	2	20.00	-30	0	30	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	0.000
2	6	2010-11-23	1	10.00	3	-10	0	10	7	4	54.84	-37.75	22.25	60	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	0.371
2	4	2010-11-23	1	11.25	6	-17.5	2.5	20	8	4	44.84	-61.5	8.5	70	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.125	0.121
2	3	2010-11-23	1	48.50	1	28.5	38.5	10	2	5	135.35	33.25	80.25	47	t	2010-12-09 01:35:19	2010-12-09 01:35:19	3.850	1.707
2	1	2010-11-23	1	44.00	2	24	34	10	1	4	171.84	91.849999999999994	131.84999999999999	40	t	2010-12-09 01:35:19	2010-12-09 01:35:19	3.400	3.296
1	14	2010-10-19	0	0.00	17	0	0	0	9	2	70.00	30	50	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	2.500
1	9	2010-10-19	0	0.00	17	0	0	0	10	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
2	2	2010-11-23	1	10.00	5	-15	0	15	3	5	112.45	18.649999999999999	93.650000000000006	75	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	1.249
1	11	2010-10-19	2	20.00	7	-20	0	20	11	2	20.00	-20	0	20	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
2	9	2010-11-23	0	0.00	8	0	0	0	4	1	22.75	5.5	25.5	20	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	1.275
2	7	2010-11-23	0	0.00	8	0	0	0	5	1	10.00	-20	0	20	t	2010-12-09 01:35:19	2010-12-09 01:35:19	0.000	0.000
1	8	2010-10-19	0	0.00	17	0	0	0	14	1	10.00	-10	0	10	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	10	2010-10-19	0	0.00	17	0	0	0	15	1	10.00	-10	0	10	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	17	2010-10-19	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	18	2010-10-19	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:37	2010-12-09 01:34:37	0.000	0.000
1	7	2010-10-05	1	45.00	1	25	35	10	7	7	116.41	-27	53	80	t	2010-12-09 01:34:36	2010-12-09 01:34:37	3.500	0.663
1	1	2010-10-05	1	30.00	2	10	20	10	3	9	154.98	-25	65	90	t	2010-12-09 01:34:36	2010-12-09 01:34:37	2.000	0.722
1	2	2010-10-05	1	25.00	3	5	15	10	1	9	262.80	92	192	100	t	2010-12-09 01:34:36	2010-12-09 01:34:37	1.500	1.920
1	6	2010-10-05	1	10.00	4	-10	0	10	5	7	153.16	15	95	80	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	1.188
1	3	2010-10-05	1	10.00	5	-10	0	10	2	9	185.04	5	95	90	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	1.056
1	8	2010-10-05	1	10.00	6	-10	0	10	13	1	10.00	-10	0	10	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	5	2010-10-05	1	10.00	7	-10	0	10	9	5	50.00	-50	0	50	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	17	2010-10-05	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	18	2010-10-05	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	4	2010-10-05	0	0.00	17	0	0	0	4	8	153.36	-10	110	120	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.917
1	15	2010-10-05	0	0.00	17	0	0	0	6	4	120.00	40	80	40	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	2.000
1	14	2010-10-05	0	0.00	17	0	0	0	8	2	70.00	30	50	20	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	2.500
1	11	2010-10-05	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	10	2010-10-05	0	0.00	17	0	0	0	14	1	10.00	-10	0	10	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	9	2010-10-05	0	0.00	17	0	0	0	10	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	12	2010-10-05	0	0.00	17	0	0	0	11	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	13	2010-10-05	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:37	0.000	0.000
1	2	2010-09-28	2	75.00	1	35	55	20	1	8	237.36	87	177	90	t	2010-12-09 01:34:36	2010-12-09 01:34:36	2.750	1.967
1	3	2010-09-28	2	20.00	4	-20	0	20	2	8	175.04	15	95	80	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	1.188
1	4	2010-09-28	2	55.00	3	15	35	20	3	8	153.36	-10	110	120	t	2010-12-09 01:34:36	2010-12-09 01:34:36	1.750	0.917
1	6	2010-09-28	0	0.00	17	0	0	0	4	6	141.42	25	95	70	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	1.357
1	1	2010-09-28	2	20.00	5	-20	0	20	5	8	125.04	-35	45	80	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.563
1	15	2010-09-28	0	0.00	17	0	0	0	6	4	120.00	40	80	40	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	2.000
1	7	2010-09-28	0	0.00	17	0	0	0	7	6	75.42	-52	18	70	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.257
1	14	2010-09-28	2	70.00	2	30	50	20	8	2	70.00	30	50	20	t	2010-12-09 01:34:36	2010-12-09 01:34:36	2.500	2.500
1	5	2010-09-28	0	0.00	17	0	0	0	9	4	40.00	-40	0	40	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	9	2010-09-28	2	20.00	6	-20	0	20	10	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	12	2010-09-28	2	20.00	7	-20	0	20	11	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	13	2010-09-28	0	0.00	17	0	0	0	12	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	10	2010-09-28	0	0.00	17	0	0	0	13	1	10.00	-10	0	10	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	8	2010-09-28	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	11	2010-09-28	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	17	2010-09-28	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	18	2010-09-28	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	6	2010-12-14	0	0.00	19	0	0	0	3	16	362.08	50	240	190	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	1.263
1	1	2010-12-14	2	20.00	6	-30	0	30	4	20	356.60	-50	180	230	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	0.783
1	4	2010-12-14	2	20.00	5	-30	0	30	5	19	345.99	-43	197	240	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	0.821
1	5	2010-12-14	0	0.00	19	0	0	0	6	12	176.04	-80	70	150	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	0.467
1	7	2010-12-14	2	20.00	4	-20	0	20	7	11	172.37	-52	68	120	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	0.567
1	14	2010-12-14	0	0.00	19	0	0	0	9	2	70.00	30	50	20	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	2.500
1	20	2010-12-14	2	70.00	2	30	50	20	10	2	70.00	30	50	20	t	2010-12-15 02:22:15	2010-12-15 02:22:15	2.500	2.500
1	17	2010-12-14	2	60.00	3	20	40	20	11	2	60.00	20	40	20	t	2010-12-15 02:22:15	2010-12-15 02:22:15	2.000	2.000
1	4	2010-09-21	2	75.00	1	35	55	20	5	6	105.00	-25	75	100	t	2010-12-09 01:34:36	2010-12-09 01:34:36	2.750	0.750
1	9	2010-12-14	0	0.00	19	0	0	0	12	4	40.00	-50	0	50	t	2010-12-15 02:22:15	2010-12-15 02:22:16	0.000	0.000
1	6	2010-09-21	2	70.00	2	30	50	20	3	6	141.42	25	95	70	t	2010-12-09 01:34:36	2010-12-09 01:34:36	2.500	1.357
1	11	2010-12-14	0	0.00	19	0	0	0	13	2	20.00	-20	0	20	t	2010-12-15 02:22:15	2010-12-15 02:22:16	0.000	0.000
1	1	2010-09-21	2	45.00	3	5	25	20	6	6	105.00	-15	45	60	t	2010-12-09 01:34:36	2010-12-09 01:34:36	1.250	0.750
1	3	2010-09-21	2	40.00	4	0	20	20	2	6	154.98	35	95	60	t	2010-12-09 01:34:36	2010-12-09 01:34:36	1.000	1.583
1	12	2010-12-14	0	0.00	19	0	0	0	14	2	20.00	-20	0	20	t	2010-12-15 02:22:15	2010-12-15 02:22:16	0.000	0.000
1	13	2010-12-14	0	0.00	19	0	0	0	15	2	20.00	-20	0	20	t	2010-12-15 02:22:15	2010-12-15 02:22:16	0.000	0.000
1	2	2010-09-21	2	20.00	5	-20	0	20	1	6	164.58	52	122	70	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	1.743
1	13	2010-09-21	2	20.00	6	-20	0	20	9	2	20.00	-20	0	20	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	7	2010-09-21	2	20.00	7	-30	0	30	7	6	75.42	-52	18	70	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.257
1	17	2010-09-21	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	18	2010-09-21	0	0.00	17	0	\N	\N	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	15	2010-09-21	0	0.00	17	0	0	0	4	4	120.00	40	80	40	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	2.000
1	8	2010-09-21	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	8	2010-12-14	0	0.00	19	0	0	0	16	1	10.00	-10	0	10	t	2010-12-15 02:22:15	2010-12-15 02:22:16	0.000	0.000
1	9	2010-09-21	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	11	2010-09-21	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	12	2010-09-21	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	14	2010-09-21	0	0.00	17	0	0	0	17	0	0.00	0	0	0	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	10	2010-09-21	0	0.00	17	0	0	0	10	1	10.00	-10	0	10	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	5	2010-09-21	0	0.00	17	0	0	0	8	4	40.00	-40	0	40	t	2010-12-09 01:34:36	2010-12-09 01:34:36	0.000	0.000
1	10	2010-12-14	0	0.00	19	0	0	0	17	1	10.00	-10	0	10	t	2010-12-15 02:22:15	2010-12-15 02:22:16	0.000	0.000
1	18	2010-12-14	0	0.00	19	0	0	0	19	0	0.00	0	0	0	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	0.000
1	19	2010-12-14	0	0.00	19	0	0	0	19	0	0.00	0	0	0	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	0.000
1	2	2010-12-14	2	70.00	1	30	50	20	1	20	519.20	137	367	230	t	2010-12-15 02:22:15	2010-12-15 02:22:15	2.500	1.596
1	3	2010-12-14	0	0.00	19	0	0	0	2	18	396.00	38	228	190	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	1.200
1	15	2010-12-14	0	0.00	19	0	0	0	8	4	120.00	40	80	40	t	2010-12-15 02:22:15	2010-12-15 02:22:15	0.000	2.000
\.


--
-- Data for Name: ranking_player; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY ranking_player (ranking_id, people_id, total_events, total_score, total_balance, total_prize, total_paid, enabled, created_at, updated_at, total_average, allow_edit) FROM stdin;
2	3	0	135.35	33.25	80.25	47	t	2010-11-16 17:16:31	2010-11-24 12:41:25	1.707	f
1	18	0	0.00	0	0	0	t	2010-12-06 18:30:28	2010-12-08 09:20:44	0.000	f
1	6	16	362.08	50	240	190	t	2010-11-16 00:41:08	2010-12-15 12:16:24	1.263	f
1	3	18	396.00	38	228	190	t	2010-11-16 00:40:32	2010-12-10 15:39:58	1.200	t
1	11	2	20.00	-20	0	20	t	2010-11-16 12:43:52	2010-11-24 21:46:56	0.000	f
2	5	0	20.00	-30	0	30	t	2010-11-16 17:17:02	2010-11-24 12:41:25	0.000	f
2	9	0	22.75	5.5	25.5	20	t	2010-11-16 17:16:20	2010-11-24 12:41:25	1.275	f
2	6	0	54.84	-37.75	22.25	60	t	2010-11-16 17:17:12	2010-11-24 12:41:25	0.371	f
2	7	0	10.00	-20	0	20	t	2010-11-16 17:16:52	2010-11-24 12:41:25	0.000	f
1	12	2	20.00	-20	0	20	t	2010-11-16 12:44:14	2010-11-24 21:46:56	0.000	f
1	9	4	40.00	-50	0	50	t	2010-11-16 12:42:34	2010-12-08 09:13:35	0.000	f
1	15	4	120.00	40	80	40	t	2010-11-16 12:45:35	2010-11-24 21:46:56	2.000	f
1	14	2	70.00	30	50	20	t	2010-11-16 12:44:55	2010-12-15 12:14:47	2.500	f
1	13	2	20.00	-20	0	20	t	2010-11-16 12:44:29	2010-11-24 21:46:56	0.000	f
2	1	0	171.84	91.849999999999994	131.84999999999999	40	t	2010-11-16 17:14:40	2010-11-24 12:41:25	3.296	f
2	4	0	44.84	-61.5	8.5	70	t	2010-11-16 17:17:53	2010-11-24 12:41:25	0.121	f
1	8	1	10.00	-10	0	10	t	2010-11-16 12:42:23	2010-11-24 21:46:55	0.000	f
1	10	1	10.00	-10	0	10	t	2010-11-16 12:43:11	2010-11-24 21:46:56	0.000	f
1	5	12	176.04	-80	70	150	t	2010-11-16 00:40:58	2010-12-08 13:23:58	0.467	f
2	2	0	112.45	18.649999999999999	93.650000000000006	75	t	2010-11-16 17:17:25	2010-12-09 01:35:22	1.249	f
1	19	0	0.00	0	0	0	t	2010-12-12 23:59:11	2010-12-12 23:59:11	0.000	f
1	7	11	172.37	-52	68	120	t	2010-11-16 00:41:23	2010-12-15 02:22:15	0.567	f
1	20	2	70.00	30	50	20	t	2010-12-15 02:13:06	2010-12-15 02:22:15	2.500	f
1	1	20	356.60	-50	180	230	t	2010-11-16 00:38:51	2010-12-15 02:22:15	0.783	f
1	17	2	60.00	20	40	20	t	2010-12-06 18:29:33	2010-12-15 02:22:15	2.000	f
1	4	19	345.99	-43	197	240	t	2010-11-16 00:40:44	2010-12-15 12:16:40	0.821	f
1	2	20	519.20	137	367	230	t	2010-11-16 00:40:22	2010-12-15 02:22:15	1.596	t
\.


--
-- Data for Name: user_site; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY user_site (id, people_id, username, password, last_access_date, active, created_at, updated_at, enabled, visible, deleted, locked) FROM stdin;
2	2	omegalinux	336b6ee9968d4bc46f2a66118416a9c6	2010-12-15 12:19:19	t	2010-11-23 10:38:14	2010-12-15 12:19:19	t	t	f	f
5	11	azeitonex	0e7672dbc461f9b98f7c0ecefcad03a0	\N	t	2010-11-24 11:07:01	2010-11-24 11:07:01	t	t	f	f
7	16	csartore	d4c8e4893703fded7413559172453396	\N	t	2010-11-24 17:55:11	2010-11-24 17:55:11	t	t	f	f
6	6	leowww	743fdd30fc359efb30bcef5236a519b2	2010-12-16 07:52:44	t	2010-11-24 13:26:28	2010-12-16 07:52:44	t	t	f	f
8	7	Parrilha	ccc64f367c1635f1005b6e667a6c1510	2010-12-16 03:12:41	t	2010-11-25 18:14:19	2010-12-16 03:12:41	t	t	f	f
13	20	guilhermelimpo	58318a8768ad9da929f8e1bef13936fd	2010-12-15 11:13:42	t	2010-12-15 11:13:42	2010-12-15 11:13:42	t	t	f	f
11	17	Marcelo	5e0f8edf86456dd342fc5b1a0f7052f1	2010-12-16 07:59:49	t	2010-12-07 09:37:18	2010-12-16 07:59:49	t	t	f	f
9	3	diogow	91da4589b012c2fe1ceac1fb2363dbc6	2010-12-14 17:59:32	t	2010-11-29 14:18:09	2010-12-14 17:59:32	t	t	f	f
3	5	kauedb	a3d949af326c03d60d27af05d8e01991	2010-12-16 09:16:26	t	2010-11-23 20:35:54	2010-12-16 09:16:26	t	t	f	f
4	4	rrancan	c34a374da01bee2fc167d7c335687b84	2010-12-16 10:14:11	t	2010-11-24 10:52:18	2010-12-16 10:14:11	t	t	f	f
1	1	lstegun	cf9991719a25bbd5c5bbd33ed79a83a6	2010-12-16 10:15:50	t	2010-11-16 00:38:31	2010-12-16 10:15:50	t	t	f	f
10	9	idanez	c4ef1d8e9b13a019b7144e932c306c48	2010-12-16 10:16:19	t	2010-11-30 15:14:49	2010-12-16 10:16:19	t	t	f	f
12	19	FlavioNF	88ed573974dd793c84c7071b64366aa2	2010-12-12 19:13:06	t	2010-12-12 19:10:12	2010-12-12 19:13:06	t	t	f	f
\.


--
-- Data for Name: user_site_option; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY user_site_option (people_id, user_site_option_id, option_value, created_at, updated_at) FROM stdin;
4	14	1	2010-11-24 10:52:18	2010-11-24 10:52:18
4	15	1	2010-11-24 10:52:18	2010-11-24 10:52:18
4	16	1	2010-11-24 10:52:18	2010-11-24 10:52:18
4	17	1	2010-11-24 10:52:18	2010-11-24 10:52:18
11	14	1	2010-11-24 11:07:01	2010-11-24 11:07:01
11	15	1	2010-11-24 11:07:01	2010-11-24 11:07:01
11	16	1	2010-11-24 11:07:01	2010-11-24 11:07:01
11	17	1	2010-11-24 11:07:01	2010-11-24 11:07:01
2	14	1	2010-11-23 10:38:14	2010-11-23 10:38:14
2	15	1	2010-11-23 10:38:14	2010-11-23 10:38:14
2	16	1	2010-11-23 10:38:14	2010-11-23 10:38:14
2	17	1	2010-11-23 10:38:14	2010-11-23 10:38:14
5	14	1	2010-11-23 20:35:54	2010-11-23 20:35:54
5	15	1	2010-11-23 20:35:54	2010-11-23 20:35:54
5	16	1	2010-11-23 20:35:54	2010-11-23 20:35:54
5	17	1	2010-11-23 20:35:54	2010-11-23 20:35:54
6	14	1	2010-11-24 13:26:28	2010-11-24 13:26:28
6	15	1	2010-11-24 13:26:28	2010-11-24 13:26:28
6	16	1	2010-11-24 13:26:28	2010-11-24 13:26:28
6	17	1	2010-11-24 13:26:28	2010-11-24 13:26:28
16	14	1	2010-11-24 17:55:11	2010-11-24 17:55:11
16	15	1	2010-11-24 17:55:11	2010-11-24 17:55:11
16	16	1	2010-11-24 17:55:11	2010-11-24 17:55:11
16	17	1	2010-11-24 17:55:11	2010-11-24 17:55:11
7	15	1	2010-11-25 18:14:19	2010-11-25 18:14:19
7	16	1	2010-11-25 18:14:19	2010-11-25 18:14:19
7	17	1	2010-11-25 18:14:19	2010-11-25 18:14:19
7	18	1	2010-11-25 18:14:19	2010-11-25 18:14:19
3	15	1	2010-11-29 14:18:09	2010-11-29 14:18:09
3	16	1	2010-11-29 14:18:09	2010-11-29 14:18:09
3	17	1	2010-11-29 14:18:09	2010-11-29 14:18:09
3	18	1	2010-11-29 14:18:09	2010-11-29 14:18:09
17	15	1	2010-12-07 09:37:18	2010-12-07 09:37:18
17	16	1	2010-12-07 09:37:18	2010-12-07 09:37:18
17	17	1	2010-12-07 09:37:18	2010-12-07 09:37:18
17	18	1	2010-12-07 09:37:18	2010-12-07 09:37:18
19	15	1	2010-12-12 19:10:12	2010-12-12 19:10:12
19	16	1	2010-12-12 19:10:12	2010-12-12 19:10:12
19	17	1	2010-12-12 19:10:12	2010-12-12 19:10:12
19	18	1	2010-12-12 19:10:12	2010-12-12 19:10:12
20	15	1	2010-12-15 11:13:42	2010-12-15 11:13:42
20	16	1	2010-12-15 11:13:42	2010-12-15 11:13:42
20	17	1	2010-12-15 11:13:42	2010-12-15 11:13:42
20	18	1	2010-12-15 11:13:42	2010-12-15 11:13:42
4	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
3	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
5	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
6	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
7	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
11	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
8	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
13	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
9	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
10	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
2	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
1	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
9	15	1	2010-11-30 15:14:49	2010-11-30 15:14:49
9	16	1	2010-11-30 15:14:49	2010-11-30 15:14:49
9	17	1	2010-11-30 15:14:49	2010-11-30 15:14:49
9	18	1	2010-11-30 15:14:49	2010-11-30 15:14:49
12	19	1	2010-12-16 03:04:47.757377	2010-12-16 03:04:47.757377
\.


--
-- Data for Name: virtual_table; Type: TABLE DATA; Schema: public; Owner: irank
--

COPY virtual_table (id, virtual_table_name, description, tag_name, enabled, visible, locked, deleted, created_at, updated_at) FROM stdin;
1	peopleType	Usuário administrativo	userAdmin	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
2	peopleType	Usuário do site	userSite	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
3	peopleType	Membro de ranking	rankingPlayer	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
4	gameType	Texas Hold'em	holdem	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
5	gameType	Stud	stud	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
6	gameType	Omaha	omaha	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
7	gameType	Todos	mixed	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
8	gameStyle	Torneio	tournament	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
9	gameStyle	Ring game	ring	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
10	gameStyle	Sit & Go	sitngo	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
12	rankingType	Pontos	score	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
13	rankingType	Balanço	balance	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
14	rankingType	Média	average	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
15	userSiteOption	Confirmação de presença dos convidados para os eventos	receiveFriendEventConfirmNotify	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
16	userSiteOption	Notificar eventos agendados para o dia	receiveEventReminder0	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
17	userSiteOption	Notificar eventos agendados para 3 dias	receiveEventReminder3	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
18	userSiteOption	Notificar eventos agendados para 7 dias	receiveEventReminder7	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
11	rankingType	Ganhos	value	t	t	f	f	2010-11-25 17:23:47.175544	2010-11-25 17:23:47.175544
19	userSiteOption	Notificar novo comentário nos eventos	receiveEventCommentNotify	t	t	f	f	2010-12-16 02:04:10.265184	2010-12-16 02:04:10.265184
\.


--
-- Name: auxiliar_text_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY auxiliar_text
    ADD CONSTRAINT auxiliar_text_pkey PRIMARY KEY (id);


--
-- Name: config_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY config
    ADD CONSTRAINT config_pkey PRIMARY KEY (config_name);


--
-- Name: event_comment_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY event_comment
    ADD CONSTRAINT event_comment_pkey PRIMARY KEY (id);


--
-- Name: event_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY event
    ADD CONSTRAINT event_pkey PRIMARY KEY (id);


--
-- Name: event_player_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY event_player
    ADD CONSTRAINT event_player_pkey PRIMARY KEY (event_id, people_id);


--
-- Name: faq_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY faq
    ADD CONSTRAINT faq_pkey PRIMARY KEY (id);


--
-- Name: file_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY file
    ADD CONSTRAINT file_pkey PRIMARY KEY (id);


--
-- Name: log_field_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY log_field
    ADD CONSTRAINT log_field_pkey PRIMARY KEY (log_id, field_name);


--
-- Name: log_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY log
    ADD CONSTRAINT log_pkey PRIMARY KEY (id);


--
-- Name: people_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY people
    ADD CONSTRAINT people_pkey PRIMARY KEY (id);


--
-- Name: ranking_history_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY ranking_history
    ADD CONSTRAINT ranking_history_pkey PRIMARY KEY (ranking_id, people_id, ranking_date);


--
-- Name: ranking_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY ranking
    ADD CONSTRAINT ranking_pkey PRIMARY KEY (id);


--
-- Name: ranking_player_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY ranking_player
    ADD CONSTRAINT ranking_player_pkey PRIMARY KEY (ranking_id, people_id);


--
-- Name: user_site_option_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY user_site_option
    ADD CONSTRAINT user_site_option_pkey PRIMARY KEY (people_id, user_site_option_id);


--
-- Name: user_site_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY user_site
    ADD CONSTRAINT user_site_pkey PRIMARY KEY (id);


--
-- Name: virtual_table_pkey; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY virtual_table
    ADD CONSTRAINT virtual_table_pkey PRIMARY KEY (id);


--
-- Name: virtual_table_uk_1; Type: CONSTRAINT; Schema: public; Owner: irank; Tablespace: 
--

ALTER TABLE ONLY virtual_table
    ADD CONSTRAINT virtual_table_uk_1 UNIQUE (virtual_table_name, tag_name);


--
-- Name: auxiliar_text_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY auxiliar_text
    ADD CONSTRAINT auxiliar_text_fk_1 FOREIGN KEY (file_id) REFERENCES file(id);


--
-- Name: event_comment_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY event_comment
    ADD CONSTRAINT event_comment_fk_1 FOREIGN KEY (event_id) REFERENCES event(id);


--
-- Name: event_comment_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY event_comment
    ADD CONSTRAINT event_comment_fk_2 FOREIGN KEY (people_id) REFERENCES people(id);


--
-- Name: event_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY event
    ADD CONSTRAINT event_fk_1 FOREIGN KEY (ranking_id) REFERENCES ranking(id);


--
-- Name: event_player_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY event_player
    ADD CONSTRAINT event_player_fk_1 FOREIGN KEY (event_id) REFERENCES event(id);


--
-- Name: event_player_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY event_player
    ADD CONSTRAINT event_player_fk_2 FOREIGN KEY (people_id) REFERENCES people(id);


--
-- Name: log_field_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY log_field
    ADD CONSTRAINT log_field_fk_1 FOREIGN KEY (log_id) REFERENCES log(id) ON DELETE CASCADE;


--
-- Name: log_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY log
    ADD CONSTRAINT log_fk_1 FOREIGN KEY (user_site_id) REFERENCES user_site(id);


--
-- Name: people_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY people
    ADD CONSTRAINT people_fk_1 FOREIGN KEY (people_type_id) REFERENCES virtual_table(id);


--
-- Name: ranking_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking
    ADD CONSTRAINT ranking_fk_1 FOREIGN KEY (user_site_id) REFERENCES user_site(id);


--
-- Name: ranking_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking
    ADD CONSTRAINT ranking_fk_2 FOREIGN KEY (ranking_type_id) REFERENCES virtual_table(id);


--
-- Name: ranking_fk_3; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking
    ADD CONSTRAINT ranking_fk_3 FOREIGN KEY (game_style_id) REFERENCES virtual_table(id);


--
-- Name: ranking_member_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking_history
    ADD CONSTRAINT ranking_member_fk_1 FOREIGN KEY (ranking_id) REFERENCES ranking(id);


--
-- Name: ranking_member_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking_history
    ADD CONSTRAINT ranking_member_fk_2 FOREIGN KEY (people_id) REFERENCES people(id);


--
-- Name: ranking_player_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking_player
    ADD CONSTRAINT ranking_player_fk_1 FOREIGN KEY (ranking_id) REFERENCES ranking(id);


--
-- Name: ranking_player_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY ranking_player
    ADD CONSTRAINT ranking_player_fk_2 FOREIGN KEY (people_id) REFERENCES people(id);


--
-- Name: user_site_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY user_site
    ADD CONSTRAINT user_site_fk_1 FOREIGN KEY (people_id) REFERENCES people(id);


--
-- Name: user_site_option_fk_1; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY user_site_option
    ADD CONSTRAINT user_site_option_fk_1 FOREIGN KEY (people_id) REFERENCES people(id);


--
-- Name: user_site_option_fk_2; Type: FK CONSTRAINT; Schema: public; Owner: irank
--

ALTER TABLE ONLY user_site_option
    ADD CONSTRAINT user_site_option_fk_2 FOREIGN KEY (user_site_option_id) REFERENCES virtual_table(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: irank
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM irank;
GRANT ALL ON SCHEMA public TO irank;


--
-- PostgreSQL database dump complete
--

