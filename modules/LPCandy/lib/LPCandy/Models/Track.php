<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_tracking")
*/
class Track extends \DoctrineExtensions\ActiveEntity\ActiveEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(type="array") */
    public $data;
    
    /** @Column(type="datetime") */
    public $date;
    
    /** @Column(length=128) */ 
    public $ip;
    
    /** @Column(type="integer") */ 
    public $status;
        /*
        0 - new order
        1 - order to work
        2 - order is complete
        3 - order is canceled
        */
    
    /**
     * @ManyToOne(targetEntity="Page")
     * @JoinColumn(name="page_id", referencedColumnName="id",onDelete="SET NULL")
     */
    public $page;
    
    /** @Column(length=1024) */ 
    public $page_title;
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;    

    function __construct() {
        $this->date = new \DateTime();
        $this->data = array();
    }
}