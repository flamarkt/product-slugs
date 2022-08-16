import {extend} from 'flarum/common/extend';
import ProductShowPage from 'flamarkt/core/backoffice/pages/ProductShowPage';
import Product from 'flamarkt/core/common/models/Product';

app.initializers.add('flamarkt-product-slugs', () => {
    extend(ProductShowPage.prototype, 'oninit', function () {
        this.slug = '';
    });

    extend(ProductShowPage.prototype, 'show', function (returnValue, product: Product) {
        this.slug = product.attribute('slugEdit') || '';
    });

    extend(ProductShowPage.prototype, 'fields', function (fields) {
        fields.add('slug', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-product-slugs.backoffice.products.field.slug')),
            m('input.FormControl', {
                type: 'text',
                value: this.slug,
                oninput: (event: Event) => {
                    this.slug = (event.target as HTMLInputElement).value;
                    this.dirty = true;
                },
                disabled: this.saving,
            }),
        ]), 49);
    });

    extend(ProductShowPage.prototype, 'data', function (data: any) {
        data.slug = this.slug;
    });
});
