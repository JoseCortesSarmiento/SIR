PGDMP     #    8                x           sistemarest    11.5    11.5     7           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            8           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            9           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            :           1262    16415    sistemarest    DATABASE     �   CREATE DATABASE sistemarest WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Mexico.1252' LC_CTYPE = 'Spanish_Mexico.1252';
    DROP DATABASE sistemarest;
             postgres    false                        3079    16504    pgcrypto 	   EXTENSION     <   CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;
    DROP EXTENSION pgcrypto;
                  false            ;           0    0    EXTENSION pgcrypto    COMMENT     <   COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';
                       false    2                       1247    16570    descripcionhistorial    TYPE     �   CREATE TYPE public.descripcionhistorial AS (
	primer_texto character varying,
	numero_usuario integer,
	segundo_texto character varying,
	tercer_texto character varying
);
 '   DROP TYPE public.descripcionhistorial;
       public       postgres    false            �            1259    16416 	   historial    TABLE     �   CREATE TABLE public.historial (
    id_historial integer NOT NULL,
    id_usuario integer NOT NULL,
    descripcion public.descripcionhistorial,
    fecha timestamp without time zone
);
    DROP TABLE public.historial;
       public         postgres    false    639            �            1259    16422    historial_id_historial_seq    SEQUENCE     �   CREATE SEQUENCE public.historial_id_historial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.historial_id_historial_seq;
       public       postgres    false    197            <           0    0    historial_id_historial_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.historial_id_historial_seq OWNED BY public.historial.id_historial;
            public       postgres    false    198            �            1259    16424    usuarios    TABLE     `  CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    correo character varying(50) NOT NULL,
    contra character varying(50) NOT NULL,
    nombre character varying(50) NOT NULL,
    estatus boolean DEFAULT false,
    rol boolean DEFAULT false,
    nacimiento date,
    CONSTRAINT nacimiento CHECK ((nacimiento >= '1900-01-01'::date))
);
    DROP TABLE public.usuarios;
       public         postgres    false            �            1259    16429    usuarios_id_usuario_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.usuarios_id_usuario_seq;
       public       postgres    false    199            =           0    0    usuarios_id_usuario_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;
            public       postgres    false    200            �
           2604    16431    historial id_historial    DEFAULT     �   ALTER TABLE ONLY public.historial ALTER COLUMN id_historial SET DEFAULT nextval('public.historial_id_historial_seq'::regclass);
 E   ALTER TABLE public.historial ALTER COLUMN id_historial DROP DEFAULT;
       public       postgres    false    198    197            �
           2604    16432    usuarios id_usuario    DEFAULT     z   ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);
 B   ALTER TABLE public.usuarios ALTER COLUMN id_usuario DROP DEFAULT;
       public       postgres    false    200    199            1          0    16416 	   historial 
   TABLE DATA               Q   COPY public.historial (id_historial, id_usuario, descripcion, fecha) FROM stdin;
    public       postgres    false    197   �       3          0    16424    usuarios 
   TABLE DATA               `   COPY public.usuarios (id_usuario, correo, contra, nombre, estatus, rol, nacimiento) FROM stdin;
    public       postgres    false    199          >           0    0    historial_id_historial_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.historial_id_historial_seq', 99, true);
            public       postgres    false    198            ?           0    0    usuarios_id_usuario_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 65, true);
            public       postgres    false    200            �
           2606    16434    historial historial_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.historial
    ADD CONSTRAINT historial_pkey PRIMARY KEY (id_historial);
 B   ALTER TABLE ONLY public.historial DROP CONSTRAINT historial_pkey;
       public         postgres    false    197            �
           2606    16436    usuarios usuarios_correo_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);
 F   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_correo_key;
       public         postgres    false    199            �
           2606    16438    usuarios usuarios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public         postgres    false    199            1     x��ұN1��9y��&�Zˎ����[���*�J+���'�@���G?��|V�z��iz���ᜆ��fH/c���~|>���i�}��a�3nQ�L�����PID��9��}���o��L�L6�Y=�͠����p�C�����h���:W��c(��=�	h�,ݥPh57;xe�%z���:*ŤzG9��R�74@eF�.��
n�&�P��H-�θ�fp��B��;XB��B��@�,��:�.Ն܇�9����*5����}�>�.���M�T4�G�1~��6�      3     x�e��r�0��sx
�Y�����Z���uz�L[B��0��z�#�b�N{�����7����l'n9�$a��pn'�+1y|q��FT;,{����� y���nu4P�3N[P:;�9Q�M���ȋ��iH����!����4 �iY��E���� �ky�5�ߏgn$�)� =\�N@�����Y�8�"ݗ��h��'�rU�xeM��i1�AC<����D�'�H�J�����8>�fm�7Ka�/��k7�,r~����L4M���r�     