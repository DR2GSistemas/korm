<?php


namespace DR2GSistemas\korm\dummies;


use DR2GSistemas\korm\classes\Column;
use DR2GSistemas\korm\classes\Entity;
use DR2GSistemas\korm\classes\Index;

/*
 * @tablename productossss
 */
class Product extends Entity
{
    #[Column("int", autoincrement: true, primarykey: true)]
    public int $codigo;
    #[Column("varchar(100)", nullable: false)]
    #[Index("idx_nombre")]
    public string $nombre;
    #[Column("numeric(10,2)")]
    public float $precio;
    #[Column("date")]
    #[Index("idx_fecha")]
    #[Index("idx_fecha_desc", sort: "DESC")]
    public $date;


}
