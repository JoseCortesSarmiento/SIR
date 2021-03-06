PGDMP                         x           sistemarest    11.5    11.5                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    16415    sistemarest    DATABASE     �   CREATE DATABASE sistemarest WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Mexico.1252' LC_CTYPE = 'Spanish_Mexico.1252';
    DROP DATABASE sistemarest;
             postgres    false            �            1259    16416 	   historial    TABLE     �   CREATE TABLE public.historial (
    id_historial integer NOT NULL,
    id_usuario integer NOT NULL,
    descripcion text,
    fecha timestamp without time zone
);
    DROP TABLE public.historial;
       public         postgres    false            �            1259    16422    historial_id_historial_seq    SEQUENCE     �   CREATE SEQUENCE public.historial_id_historial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.historial_id_historial_seq;
       public       postgres    false    196                       0    0    historial_id_historial_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.historial_id_historial_seq OWNED BY public.historial.id_historial;
            public       postgres    false    197            �            1259    16424    usuarios    TABLE       CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    correo character varying(50) NOT NULL,
    contra character varying(50) NOT NULL,
    nombre character varying(50) NOT NULL,
    estatus boolean DEFAULT false,
    rol boolean DEFAULT false
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
       public       postgres    false    198                       0    0    usuarios_id_usuario_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;
            public       postgres    false    199            �
           2604    16431    historial id_historial    DEFAULT     �   ALTER TABLE ONLY public.historial ALTER COLUMN id_historial SET DEFAULT nextval('public.historial_id_historial_seq'::regclass);
 E   ALTER TABLE public.historial ALTER COLUMN id_historial DROP DEFAULT;
       public       postgres    false    197    196            �
           2604    16432    usuarios id_usuario    DEFAULT     z   ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);
 B   ALTER TABLE public.usuarios ALTER COLUMN id_usuario DROP DEFAULT;
       public       postgres    false    199    198                      0    16416 	   historial 
   TABLE DATA               Q   COPY public.historial (id_historial, id_usuario, descripcion, fecha) FROM stdin;
    public       postgres    false    196   -       
          0    16424    usuarios 
   TABLE DATA               T   COPY public.usuarios (id_usuario, correo, contra, nombre, estatus, rol) FROM stdin;
    public       postgres    false    198   �                  0    0    historial_id_historial_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.historial_id_historial_seq', 4, true);
            public       postgres    false    197                       0    0    usuarios_id_usuario_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 1, true);
            public       postgres    false    199            �
           2606    16434    historial historial_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.historial
    ADD CONSTRAINT historial_pkey PRIMARY KEY (id_historial);
 B   ALTER TABLE ONLY public.historial DROP CONSTRAINT historial_pkey;
       public         postgres    false    196            �
           2606    16436    usuarios usuarios_correo_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);
 F   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_correo_key;
       public         postgres    false    198            �
           2606    16438    usuarios usuarios_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public         postgres    false    198            �
           2606    16439 #   historial historial_id_usuario_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.historial
    ADD CONSTRAINT historial_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario) ON UPDATE CASCADE;
 M   ALTER TABLE ONLY public.historial DROP CONSTRAINT historial_id_usuario_fkey;
       public       postgres    false    196    198    2701               l   x�����0 �w<E �'[�c?����"#������}�Q����jv��Hq�y��c�\$�P�p���]����`.��X����%�'b� x�70�      
   ,   x�3�L�/*J�w�M���K����;�$���s�q�q��qqq ͫZ     