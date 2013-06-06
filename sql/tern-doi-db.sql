--
-- PostgreSQL database dump
--

-- Started on 2011-11-21 09:19:31

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 1783 (class 1262 OID 34839)
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
-- Name: id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE id
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.id OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1497 (class 1259 OID 34854)
-- Dependencies: 1776 3
-- Name: tbl_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_doc (
    doc_url character varying(256) NOT NULL,
    doc_id integer NOT NULL,
    doc_xml text NOT NULL,
    doc_status character varying(128),
    doc_doi character varying(128),
    doc_doi_date timestamp without time zone DEFAULT ('now'::text)::timestamp without time zone NOT NULL
);


ALTER TABLE public.tbl_doc OWNER TO postgres;

--
-- TOC entry 1495 (class 1259 OID 34840)
-- Dependencies: 1775 3
-- Name: tbl_user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_user
(
  username character varying(128),
  email character varying(128),
  approved boolean,
  facility character varying(128),
  user_id character varying(128) NOT NULL,
  enabled boolean,
  CONSTRAINT id PRIMARY KEY (user_id)
)
WITH (
  OIDS=FALSE
);

ALTER TABLE public.tbl_user OWNER TO postgres;

--
-- TOC entry 1780 (class 2606 OID 34871)
-- Dependencies: 1497 1497
-- Name: pk_doc_id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_doc
    ADD CONSTRAINT pk_doc_id PRIMARY KEY (doc_id);


--
-- TOC entry 1778 (class 2606 OID 34844)
-- Dependencies: 1495 1495
-- Name: tbl_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_user
    ADD CONSTRAINT tbl_user_pkey PRIMARY KEY (user_id);


--
-- TOC entry 1785 (class 0 OID 0)
-- Dependencies: 3
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2011-11-21 09:19:37

--
-- PostgreSQL database dump complete
--

