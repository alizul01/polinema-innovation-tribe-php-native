/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     12/12/2022 3:35:34 PM                        */
/*==============================================================*/

CREATE DATABASE 20221212_projectakhir;

USE 20221212_projectakhir;

drop table if exists IDEA_BOX;
drop table if exists USER;

/*==============================================================*/
/* Table: IDEA_BOX                                              */
/*==============================================================*/
create table IDEA_BOX
(
   ID_IDEA              int not null,
   ID                   int not null,
   JUDUL                varchar(255),
   KATEGORI             varchar(128),
   DESKRIPSI            text,
   TAGS                 varchar(255),
   primary key (ID_IDEA)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID                   int not null,
   NAMA                 varchar(255),
   EMAIL                varchar(255),
   ROLES                varchar(128),
   PASSWORD             varchar(1024),
   CREATED_AT           timestamp,
   UPDATED_AT           DATETIME,
   primary key (ID)
);

alter table IDEA_BOX add constraint FK_MEMILIKI foreign key (ID)
      references USER (ID) on delete restrict on update restrict;

BEGIN

END;