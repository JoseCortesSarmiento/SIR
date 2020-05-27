--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2 (Debian 12.2-4)
-- Dumped by pg_dump version 12.2 (Debian 12.2-4)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: historial; Type: TABLE; Schema: public; Owner: jose
--

CREATE TABLE public.historial (
    id_historial integer NOT NULL,
    id_usuario integer NOT NULL,
    descripcion text,
    fecha timestamp without time zone
);


ALTER TABLE public.historial OWNER TO jose;

--
-- Name: historial_id_historial_seq; Type: SEQUENCE; Schema: public; Owner: jose
--

CREATE SEQUENCE public.historial_id_historial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.historial_id_historial_seq OWNER TO jose;

--
-- Name: historial_id_historial_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: jose
--

ALTER SEQUENCE public.historial_id_historial_seq OWNED BY public.historial.id_historial;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: jose
--

CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    correo character varying(50) NOT NULL,
    contra character varying(50) NOT NULL,
    nombre character varying(50) NOT NULL,
    estatus boolean DEFAULT false,
    rol boolean DEFAULT false
);


ALTER TABLE public.usuarios OWNER TO jose;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: jose
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_usuario_seq OWNER TO jose;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: jose
--

ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;


--
-- Name: historial id_historial; Type: DEFAULT; Schema: public; Owner: jose
--

ALTER TABLE ONLY public.historial ALTER COLUMN id_historial SET DEFAULT nextval('public.historial_id_historial_seq'::regclass);


--
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: public; Owner: jose
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);


--
-- Data for Name: historial; Type: TABLE DATA; Schema: public; Owner: jose
--

COPY public.historial (id_historial, id_usuario, descripcion, fecha) FROM stdin;
1	1	Creo receta Ensalada Caprese	2020-05-19 13:56:53.742197
3	1	Edito receta Ensalada Caprese	2020-05-19 14:10:46.241687
4	1	Creo receta Ensalada Caprese	2020-05-19 14:12:43.724324
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: jose
--

COPY public.usuarios (id_usuario, correo, contra, nombre, estatus, rol) FROM stdin;
1	correo@mail.com	correo@mail.com	Alberto	f	f
\.


--
-- Name: historial_id_historial_seq; Type: SEQUENCE SET; Schema: public; Owner: jose
--

SELECT pg_catalog.setval('public.historial_id_historial_seq', 4, true);


--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: jose
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 1, true);


--
-- Name: historial historial_pkey; Type: CONSTRAINT; Schema: public; Owner: jose
--

ALTER TABLE ONLY public.historial
    ADD CONSTRAINT historial_pkey PRIMARY KEY (id_historial);


--
-- Name: usuarios usuarios_correo_key; Type: CONSTRAINT; Schema: public; Owner: jose
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: jose
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: historial historial_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: jose
--

ALTER TABLE ONLY public.historial
    ADD CONSTRAINT historial_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario) ON UPDATE CASCADE;


--
-- PostgreSQL database dump complete
--

