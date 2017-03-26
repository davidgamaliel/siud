--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.2
-- Dumped by pg_dump version 9.6.2

-- Started on 2017-03-26 11:49:58

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 24639)
-- Name: trx_peminjaman_kendaraan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE trx_peminjaman_kendaraan (
    id integer DEFAULT nextval('trx_peminjaman_kendaraan_seq'::regclass) NOT NULL,
    kendaraan_id integer,
    ketersediaan boolean,
    peminjam character varying(250),
    kegiatan text,
    supir character varying(250),
    nodin boolean,
    status integer,
    waktu_mulai timestamp without time zone,
    waktu_selesai timestamp without time zone,
    no_polisi character varying(15)
);


ALTER TABLE trx_peminjaman_kendaraan OWNER TO postgres;

--
-- TOC entry 2148 (class 0 OID 24639)
-- Dependencies: 196
-- Data for Name: trx_peminjaman_kendaraan; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO trx_peminjaman_kendaraan (id, kendaraan_id, ketersediaan, peminjam, kegiatan, supir, nodin, status, waktu_mulai, waktu_selesai, no_polisi) VALUES (1, 1, NULL, 'Mutono', 'asd', 'Mutini', NULL, 0, NULL, NULL, NULL);
INSERT INTO trx_peminjaman_kendaraan (id, kendaraan_id, ketersediaan, peminjam, kegiatan, supir, nodin, status, waktu_mulai, waktu_selesai, no_polisi) VALUES (2, 2, NULL, 'Joko', 'dfg', 'Jiki', NULL, 1, NULL, NULL, NULL);
INSERT INTO trx_peminjaman_kendaraan (id, kendaraan_id, ketersediaan, peminjam, kegiatan, supir, nodin, status, waktu_mulai, waktu_selesai, no_polisi) VALUES (3, 2, NULL, 'Agung', 'zxc', 'Igung', NULL, 99, NULL, NULL, NULL);
INSERT INTO trx_peminjaman_kendaraan (id, kendaraan_id, ketersediaan, peminjam, kegiatan, supir, nodin, status, waktu_mulai, waktu_selesai, no_polisi) VALUES (4, 4, NULL, 'Budi', 'qwe', 'Bidu', NULL, 1, NULL, NULL, NULL);


--
-- TOC entry 2029 (class 2606 OID 24647)
-- Name: trx_peminjaman_kendaraan trx_peminjaman_kendaraan_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY trx_peminjaman_kendaraan
    ADD CONSTRAINT trx_peminjaman_kendaraan_pk PRIMARY KEY (id);


--
-- TOC entry 2030 (class 2606 OID 24648)
-- Name: trx_peminjaman_kendaraan fk_kendaraan_id_trx_peminjaman_kendaraan; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY trx_peminjaman_kendaraan
    ADD CONSTRAINT fk_kendaraan_id_trx_peminjaman_kendaraan FOREIGN KEY (kendaraan_id) REFERENCES mst_kendaraan(id);


-- Completed on 2017-03-26 11:49:58

--
-- PostgreSQL database dump complete
--

