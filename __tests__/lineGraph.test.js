import { mount } from '@vue/test-utils'
import LineChart from '../assets/components/LineChart'

const wrapper = mount(LineChart)

describe('LineChart', () => {
    it('has data', () => {
        expect(typeof LineChart.data).toBe('function')
    });

    it('does a wrapper exist', () => {
        expect(wrapper.exists()).toBe(true)
    });

    it('Call update method', () => {
        let labels = ['A', 'B', 'C'];
        let scores = [1, 2, 3];
        let reviews = [10, 20, 30];
        let response = wrapper.vm.update(labels, scores, reviews);
        expect(response).toBe(undefined);
        expect(wrapper.vm.data.type).toBe('line');
    });
});