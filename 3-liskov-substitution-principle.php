<?php

/**
 * Liskov Substitution Principle
 *
 * Let q(x) be a property provable about objects of x of type T. Then q(y) should be provable for objects y of type S
 * where S is a subtype of T.
 *
 * WTF???
 *
 * Every subclass/derived class should be substitutable for their base/parent class.
 */

class AreaCalculator {
    /**
     * @var array
     */
    protected $shapes;

    /**
     * AreaCalculator constructor.
     *
     * @param ShapeInterface[] $shapes
     */
    public function __construct( array $shapes = [] ) {
        $this->shapes = $shapes;
    }

    /**
     * @return float
     */
    public function sum() {
        $area = [];
        foreach ( $this->shapes as $shape ) {
            if ( is_a( $shape, ShapeInterface::class ) ) {
                $area[] = $shape->area();
                continue;
            }

            throw new RuntimeException();
        }

        return array_sum( $area );
    }
}

class BadVolumeCalculator extends AreaCalculator {
    /**
     * @param ShapeInterface[] $shapes
     */
    public function construct( $shapes = array() ) {
        parent::__construct( $shapes );
    }

    public function sum() {
        $summedData = 0;

        // logic to calculate the volumes and then return an array of output

        return array( $summedData );
    }
}

class SumOutput {
    /**
     * @var AreaCalculator
     */
    protected $calculator;

    public function __constructor( AreaCalculator $calculator ) {
        $this->calculator = $calculator;
    }

    public function json() {
        $data = array(
            'sum' => $this->calculator->sum()
        );

        return json_encode( $data );
    }

    /**
     * If BadVolumeCalculator is used, the following raises an E_NOTICE informing us of an array to string conversion.
     *
     * @return string
     */
    public function html() {
        return sprintf( 'Sum of the areas of the provided shapes: %d', $this->calculator->sum() );
    }
}

// Let's fix it.


class VolumeCalculator extends AreaCalculator {
    /**
     * @param ShapeInterface[] $shapes
     */
    public function construct( $shapes = array() ) {
        parent::__construct( $shapes );
    }

    public function sum() {
        $summedData = 0;

        // logic to calculate the volumes and then return an array of output

        return $summedData;
    }
}