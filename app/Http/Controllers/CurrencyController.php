<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCurrencyRequest;
use App\Models\Currency;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CurrencyController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $currencies = Currency::all();

        return view('currency.index', [
            'currencies' => $currencies,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $defaultCurrency = $this->getDefaultCurrency();

        return view('currency.create',[
            'canBeSetAsDefault' => !$defaultCurrency,
        ]);
    }

    /**
     * @param  ValidateCurrencyRequest  $request
     * @return RedirectResponse
     */
    public function store(ValidateCurrencyRequest $request)
    {
        /** @var Currency $defaultCurrency */
        $defaultCurrency = $this->getDefaultCurrency();
        if ($request->get('isDefault') && $defaultCurrency) {
            return redirect()->back()->withErrors('Default value is '.$defaultCurrency->code);
        }

        $currency = Currency::create([
            'code' => $request->get('code'),
            'symbol' => $request->get('symbol'),
            'name' => $request->get('name'),
            'isDefault' => $request->get('isDefault') ?? false ,
        ]);

        if (!$currency) {
            return redirect()->back();
        }

        $request->session()->flash('flash_message', 'Currency saved!');

        return redirect()->route('currencies.index');
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        $currency = Currency::findOrFail($id);

        return view('currency.show', [
            'currency' => $currency,
        ]);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        $defaultCurrency = $this->getDefaultCurrency();

        return view('currency.edit', [
            'currency' => $currency,
            'canBeSetAsDefault' => !$defaultCurrency || $defaultCurrency->id === (int)$id,
        ]);
    }

    /**
     * @param  ValidateCurrencyRequest  $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(ValidateCurrencyRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);
        $currency->fill($request->all());
        $currency->isDefault = $request->get('isDefault') ?? false;

        if (!$currency->save()) {
            return redirect()->back()->withErrors('Update error');
        }

        $request->session()->flash('flash_message', 'Currency updated');

        return redirect()->route('currencies.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        if (!$currency->delete()) {
            return redirect()->back()->withErrors('Delete error');
        }
        session()->flash('flash_message', 'Currency deleted');

        return redirect()->back();
    }

    private function getDefaultCurrency()
    {
        return Currency::where('isDefault','=',true)->first();
    }
}
