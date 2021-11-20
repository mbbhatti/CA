import { mount } from '@vue/test-utils'
import App from '../assets/components/App'

const wrapper = mount(App)

describe('App', () => {
    it('has data', () => {
        expect(typeof App.data).toBe('function')
    });

    it('does a wrapper exist', () => {
        expect(wrapper.exists()).toBe(true)
    });

    it('Call elements', () => {
        let hotels = ['A', 'B', 'C'];

        wrapper.setData({ hotels: hotels })
        wrapper.setData({ fromDate: '2020-12-01' })
        wrapper.setData({ toDate: '2021-11-01' })

        expect(wrapper.vm.hotels).toBe(hotels);
        expect(wrapper.vm.fromDate).toBe('2020-12-01');
        expect(wrapper.vm.toDate).toBe('2021-11-01');
    });

    it('Call display method', () => {
        let hotels = ['A', 'B', 'C'];

        wrapper.setData({ hotels: hotels })
        wrapper.setData({ fromDate: '2020-12-01' })
        wrapper.setData({ toDate: '2021-11-01' })

        expect(wrapper.vm.display()).toBe(true);
    });
});