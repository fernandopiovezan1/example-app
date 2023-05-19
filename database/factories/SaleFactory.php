<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;


class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comprador' => $this->faker->name,
            'descricao' => $this->faker->text(100),
            'preco_unitario' => $this->faker->numberBetween(0, 9223372),
            'quantidade' => $this->faker->numberBetween(0, 9223372),
            'endereco' => $this->faker->address(),
            'fornecedor' => $this->faker->name,
        ];
    }
}
