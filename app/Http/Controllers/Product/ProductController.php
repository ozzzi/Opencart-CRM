<?php

namespace App\Http\Controllers\Product;

use App\Enums\Store;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Product\Repositories\ExternalProductRepository;

class ProductController extends Controller
{
    public function __construct(
        private readonly ExternalProductRepository $productRepositoryWild = new ExternalProductRepository(Store::Wildbear),
        private readonly ExternalProductRepository $productRepositoryPro = new ExternalProductRepository(Store::Procord),
    ) {
    }

    public function index()
    {
    }

    public function show(int $productId): View
    {
        $productWildbear = $this->productRepositoryWild->find($productId);
        $productProcord = $this->productRepositoryPro->finByModel($productWildbear->sku);

        $categories = $this->productRepositoryWild->productCategories($productId);
        $attributes = $this->productRepositoryWild->productAttributes($productId);
        $options = $this->productRepositoryWild->productOptions($productId);

        return view('product.show', compact(
            'productWildbear',
            'productProcord',
            'categories',
            'attributes',
            'options'
        ));
    }
}
