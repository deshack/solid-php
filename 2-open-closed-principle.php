<?php

/**
 * Open-Closed Principle
 *
 * Objects or entities should be open for extension, but closed to modification.
 */

class BadAreaCalculator {
    /**
     * @var array
     */
    protected $shapes;

    /**
     * AreaCalculator constructor.
     *
     * @param array $shapes
     */
    public function __construct( array $shapes = [] ) {
        $this->shapes = $shapes;
    }

    /**
     * What if we add a Triangle?
     *
     * @return float
     */
    public function sum(): float {
        $area = [];
        foreach ( $this->shapes as $shape ) {
            if ( is_a( $shape, Square::class ) ) {
                $area[] = pow( $shape->length, 2 );
            } else if ( is_a( $shape, Circle::class ) ) {
                $area[] = pi() * pow( $shape->radius, 2 );
            }
        }

        return array_sum( $area );
    }
}

// Let's do some refactoring!

class Circle implements ShapeInterface {
    /**
     * @var float
     */
    public $radius;

    /**
     * Circle constructor.
     *
     * @param $radius
     */
    public function __construct( float $radius ) {
        $this->radius = $radius;
    }

    public function area(): float {
        return pi() * pow( $this->radius, 2 );
    }
}

class Square implements ShapeInterface {
    /**
     * @var float
     */
    public $length;

    /**
     * Square constructor.
     *
     * @param $length
     */
    public function __construct( float $length ) {
        $this->length = $length;
    }

    public function area(): float {
        return pow( $this->length, 2 );
    }
}

// And in AreaCalculator...

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
     * What if we add a Triangle?
     *
     * @return float
     */
    public function sum(): float {
        $area = [];
        foreach ( $this->shapes as $shape ) {
            $area[] = $shape->area;
        }

        return array_sum( $area );
    }
}

interface ShapeInterface {
    public function area(): float;
}

// Even better! Type checking based on abstraction.


class BetterAreaCalculator {
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
     * What if we add a Triangle?
     *
     * @return float
     */
    public function sum(): float {
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