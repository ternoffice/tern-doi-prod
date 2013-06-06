--
-- PostgreSQL database dump
--

-- Started on 2011-11-28 10:07:44

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 1786 (class 1262 OID 34839)
-- Name: tern-doi; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "tern-doi" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_Australia.1252' LC_CTYPE = 'English_Australia.1252';


ALTER DATABASE "tern-doi" OWNER TO postgres;

\connect "tern-doi"

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 308 (class 2612 OID 16386)
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

SET search_path = public, pg_catalog;

--
-- TOC entry 1496 (class 1259 OID 34845)
-- Dependencies: 3
-- Name: doc_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE doc_id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.doc_id OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1497 (class 1259 OID 34854)
-- Dependencies: 1776 1777 3
-- Name: tbl_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_doc (
    doc_url character varying(256) NOT NULL,
    doc_id integer DEFAULT nextval('doc_id'::regclass) NOT NULL,
    doc_xml text NOT NULL,
    doc_status character varying(128),
    doc_doi character varying(128),
    doc_doi_date timestamp without time zone DEFAULT ('now'::text)::timestamp without time zone NOT NULL,
    doc_title character varying(128),
    user_id integer
);


ALTER TABLE public.tbl_doc OWNER TO postgres;

--
-- TOC entry 1495 (class 1259 OID 34840)
-- Dependencies: 1775 3
-- Name: tbl_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_user (
    id integer DEFAULT nextval('doc_id'::regclass) NOT NULL,
    username character varying(128) NOT NULL,
    password character varying(128) NOT NULL,
    email character varying(128) NOT NULL
);


ALTER TABLE public.tbl_user OWNER TO postgres;

--
-- TOC entry 1783 (class 2606 OID 34871)
-- Dependencies: 1497 1497
-- Name: pk_doc_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_doc
    ADD CONSTRAINT pk_doc_id PRIMARY KEY (doc_id);


--
-- TOC entry 1779 (class 2606 OID 34844)
-- Dependencies: 1495 1495
-- Name: tbl_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_user
    ADD CONSTRAINT tbl_user_pkey PRIMARY KEY (id);


--
-- TOC entry 1780 (class 1259 OID 43040)
-- Dependencies: 1497
-- Name: doc_doi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX doc_doi ON tbl_doc USING btree (doc_doi);


--
-- TOC entry 1781 (class 1259 OID 43039)
-- Dependencies: 1497
-- Name: doc_title; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX doc_title ON tbl_doc USING btree (doc_title);


--
-- TOC entry 1788 (class 0 OID 0)
-- Dependencies: 3
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2011-11-28 10:07:45

--
-- PostgreSQL database dump complete
--

