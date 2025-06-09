<?php

class Product
{
    private $name;
    private $price;
    private $quantity;
    public function __construct(string $name, float $price, int $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function __toString(): string
    {
        return "Product: {$this->name}, Price: {$this->price}, Quantity: {$this->quantity}";
    }
}

class Cart
{
    private $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function removeProduct(Product $product): void
    {
        foreach ($this->products as $key => $p) {
            if ($p == $product) {
                unset($this->products[$key]);
                $this->products = array_values($this->products);
                return;
            }
        }
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }

        return $total;
    }

    public function __toString(): string
    {
        $output = "Products in cart:" . "<br>";

        foreach ($this->products as $product) {
            $output .= $product . "<br>";
        }

        $output .= "Total price: " . $this->getTotal();

        return $output;
    }
}

$product1 = new Product("Laptop", 1500.00, 1);
$product2 = new Product("Phone", 500.00, 2);

$cart = new Cart();
$cart->addProduct($product1);
$cart->addProduct($product2);

echo $cart;