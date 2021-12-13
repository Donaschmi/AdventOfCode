package helper

import "reflect"

func Index(vs []string, t string) int {
	for i, v := range vs {
		if v == t {
			return i
		}
	}
	return -1
}

func Include(vs []string, t string) bool {
	return Index(vs, t) >= 0
}

func Any(vs []string, f func(string) bool) bool {
	for _, v := range vs {
		if f(v) {
			return true
		}
	}
	return false
}

func All(vs []string, f func(string) bool) bool {
	for _, v := range vs {
		if !f(v) {
			return false
		}
	}
	return true
}
func Reduce(vs interface{}, f interface{}, in interface{}) interface{} {

	vf := reflect.ValueOf(f)
	vx := reflect.ValueOf(vs)

	l := vx.Len()

	a := reflect.New(reflect.TypeOf(in))
	v := a.Elem()

	v.Set(reflect.ValueOf(in))

	for i := 0; i < l; i++ {

		a := vf.Call([]reflect.Value{a.Elem(), vx.Index(i)})[0]
		v.Set(a)
	}

	return v.Interface()
}

func Filter(vs interface{}, f interface{}) interface{} {

	vf := reflect.ValueOf(f)
	vx := reflect.ValueOf(vs)

	l := vx.Len()

	tys := reflect.SliceOf(vf.Type().In(0))

	vss := []reflect.Value{}

	for i := 0; i < l; i++ {

		v := vx.Index(i)
		if vf.Call([]reflect.Value{v})[0].Bool() {

			vss = append(vss, v)
		}
	}

	vys := reflect.MakeSlice(tys, len(vss), len(vss))

	for i, v := range vss {
		vys.Index(i).Set(v)
	}

	return vys.Interface()
}

func Map(vs interface{}, f interface{}) interface{} {

	vf := reflect.ValueOf(f)
	vx := reflect.ValueOf(vs)

	l := vx.Len()

	tys := reflect.SliceOf(vf.Type().Out(0))
	vys := reflect.MakeSlice(tys, l, l)

	for i := 0; i < l; i++ {

		y := vf.Call([]reflect.Value{vx.Index(i)})[0]
		vys.Index(i).Set(y)
	}

	return vys.Interface()
}
