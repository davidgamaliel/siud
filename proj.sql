--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.2
-- Dumped by pg_dump version 9.6.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tmst_kendaraan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tmst_kendaraan (
    id integer NOT NULL
);


ALTER TABLE tmst_kendaraan OWNER TO postgres;

--
-- Name: tmst_kendaraan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tmst_kendaraan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tmst_kendaraan_id_seq OWNER TO postgres;

--
-- Name: tmst_kendaraan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tmst_kendaraan_id_seq OWNED BY tmst_kendaraan.id;


--
-- Name: tmst_ruangan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tmst_ruangan (
    id integer NOT NULL,
    nama character varying(50),
    gedung character varying(50),
    kapasitas integer,
    fasilitas text
);


ALTER TABLE tmst_ruangan OWNER TO postgres;

--
-- Name: COLUMN tmst_ruangan.kapasitas; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tmst_ruangan.kapasitas IS '
';


--
-- Name: tmst_ruangan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tmst_ruangan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tmst_ruangan_id_seq OWNER TO postgres;

--
-- Name: tmst_ruangan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tmst_ruangan_id_seq OWNED BY tmst_ruangan.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(50),
    password character varying(50)
);


ALTER TABLE "user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: tmst_kendaraan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tmst_kendaraan ALTER COLUMN id SET DEFAULT nextval('tmst_kendaraan_id_seq'::regclass);


--
-- Name: tmst_ruangan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tmst_ruangan ALTER COLUMN id SET DEFAULT nextval('tmst_ruangan_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Data for Name: tmst_kendaraan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tmst_kendaraan (id) FROM stdin;
\.


--
-- Name: tmst_kendaraan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tmst_kendaraan_id_seq', 1, false);


--
-- Data for Name: tmst_ruangan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tmst_ruangan (id, nama, gedung, kapasitas, fasilitas) FROM stdin;
\.


--
-- Name: tmst_ruangan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tmst_ruangan_id_seq', 1, false);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "user" (id, username, password) FROM stdin;
1	admin	admin
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 1, true);


--
-- Name: tmst_ruangan nama_ruangan_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tmst_ruangan
    ADD CONSTRAINT nama_ruangan_unique UNIQUE (nama);


--
-- Name: tmst_ruangan ruangan_primary_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tmst_ruangan
    ADD CONSTRAINT ruangan_primary_key PRIMARY KEY (id);


--
-- Name: user user_id_primary_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_id_primary_key PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

